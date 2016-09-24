
var submiter=function(formElement,success,fail)
{
	var ajaxObj={
			method:$(formElement).attr('method'),
			url: $(formElement).attr('action'),
			data:$(formElement).serialize(),
			success:success,
			fail:fail,
	};	
	
	$.ajax(ajaxObj);
};

/**
 * Represents a Member
 * @param data Data received from the Ajax request
 * @param App parent
 */
function Member(data,parent)
{
	var member=this;

	member.id=data.id
	member.name=ko.observable(data.name);
	member.email=ko.observable(data.email);
	member.schools=ko.observableArray([]);
	
	if(data.schools)
	{
		ko.utils.arrayForEach(data.schools,function(school)
		{
			member.schools.push(new School(school));
		})
	}
	
	/**
	 * Method to add a new Member
	 * @param form The form element
	 */
	member.add=function(form)
	{
		var success=function(data)
		{
			parent.getMemberAndResetPagination();
			parent.closeAll();
		};
		
		var fail=function(data)
		{
			alert("An error occured");
		};
		
		submiter(form,success,fail);
	}
}

/**
 * Represents a school
 * @param data Data received from the Ajax request
 */
function School(data)
{
	var school=this;
	
	school.id=ko.observable(data.id);
	school.name=ko.observable(data.name);
	
	school.addToMember=function(member)
	{
		var duplicate=ko.utils.arrayFirst(member.schools(),function(currentSchool)
		{
			return parseInt(currentSchool.id())==parseInt(school.id());
		});
		
		if(!duplicate)
		{
			member.schools.push(school);
		}
	};
	
	school.removeFromMember=function(member)
	{
		member.schools.remove(school)
	};
	
	/**
	 * Method that allows you  to add a new school
	 */
	school.add=function(form)
	{
		var success=function(data)
		{
			parent.closeAll();
		};
		
		var fail=function(data)
		{
			alert("An error occured");
		};
		
		submiter(form,success,fail);
	};
	
	school.filterAction=function(filterManager)
	{
		filterManager.add(school);
	}
}


/**
 * Object that pprovides the basic functionality
 */
function PagerInfo(page,limit,callback)
{
	var pager=this;
		
	pager.page=ko.observable(page);
	pager.page.subscribe(function()
	{
		callback();
	});
	
	pager.limit=ko.observable(limit);
	
	pager.callback=callback;
	
	pager.reset=function()
	{
		pager.page(page);
		pager.limit(limit);
	}
	
	pager.nextPage=function()
	{
		pager.page(pager.page()+1);
	}
}

/**
 * @param onFilterChangeCallback function
 */
function FilterManager(onFilterChangeCallback)
{
	
	var self=this;
	
	self.filters=ko.observableArray([]);
	self.filters.subscribe(function(values)
	{
		onFilterChangeCallback(values);
	});
	
	/**
	 * Add a new Value to filter
	 */
	self.add=function(value)
	{
		var existingValue=ko.utils.arrayFirst(self.filters(),function(filter)
		{
			return filter && parseInt(filter.id())==parseInt(value.id());
		});
		
		if(!existingValue)
		{
			self.filters.push(value);
		}
	};
	
	/**
	 * Remove a value from filter
	 */
	self.remove=function(value)
	{
		self.filters.remove(value);
	}
	
	/**
	 * Remove all filters
	 */
	self.clear=function()
	{
		self.filters([]);
	}
	
	/**
	 * Method to irterate all the filters
	 */
	self.traverse=function(callback)
	{
		ko.utils.arrayForEach(self.filters(),callback);
	}
}

/**
 * The main view Model
 */
function App()
{
	var self=this;
	
	self.members=ko.observableArray([]);

	self.getMembers=function()
	{
		schools=[];
		self.filterManager.traverse(function(item)
		{
			if(item)
			{
				schools.push(item.id);	
			}
		});
		
		$.get('./get/members/'+self.membersPager.page()+'/'+self.membersPager.limit(),{"schools":schools})
		.done(function(restData)
		{
			if(restData.status==true)
			{
				var data=restData.data;
				
				var members=[];
				ko.utils.arrayForEach(data,function(d)
				{
					self.members.push(new Member(d,self));
				});
			}
		})
		.fail(function()
		{
			alert("An error occured");
		});
	};
	
	self.membersPager=new PagerInfo(0,10,self.getMembers);
	
	self.addingMember=ko.observable(false);
	self.memberToAdd=null;
	
	/**
	 * Method That Initializes the form for the adding procedure
	 */
	self.initAddMember=function()
	{
		self.closeAll();
		self.memberToAdd=new Member({id:null,name:"",email:"",schools:null},self);
		self.addingMember(true);
	}
	
	
	/**
	 * Method that  closes and disapears the form
	 * for member adding procedure.
	 */
	self.endAddMember=function()
	{
		console.log("Called");
		self.addingMember(false);
		self.memberToAdd=null;
	}
	
	self.getMemberAndResetPagination=function()
	{
		self.membersPager.reset();
		self.members([]);
		self.getMembers();
	}
	
	self.filterManager=new FilterManager(self.getMemberAndResetPagination);
	
	/*#########################################*/
	
	self.schoolToAdd=null;
	self.schoolAdding=ko.observable(false);
	
	/**
	 * Method that initializes the School adding
	 */
	self.initAddSchool=function()
	{
		self.closeAll();
		self.schoolToAdd=new School({id:null,name:null});
		self.schoolAdding(true);
	}
	
	/**
	 * Close School adding
	 */
	self.endSchoolAdding=function()
	{
		self.schoolAdding(false);
		self.schoolToAdd=null;
	};
	
	self.schools=ko.observableArray([]);
	
	self.getShools=function()
	{
		self.schools([]);
		$.get('get/schools/0/0')
		.done(function(restData)
		{
			if(restData.status==true)
			{
				var data=restData.data;
				
				var members=[];
				ko.utils.arrayForEach(data,function(d)
				{
					self.schools.push(new School(d));
				});
			}
		})
		.fail(function()
		{
			alert("An error occured");
		});
	}
	
	/**
	 * Methood that closes all the openn forms
	 */
	self.closeAll=function()
	{
		self.endAddMember();
		self.endSchoolAdding();
	};
}


$(document).ready(function()
{
	var app=new App()
	
	ko.applyBindings(app);
	
	app.getMemberAndResetPagination();
});
