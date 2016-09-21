<?php
	
  $container->setParameter('secret','dhasjkaksdVGhdskRTSjjska~11mklslkjnjsslakWVENJK');

  // Db Parameters
  $container->setParameter('database_host', getenv("SYMFONY__DB_HOST"));
  $container->setParameter('database_port', getenv("SYMFONY__DB_PORT"));
  $container->setParameter('database_name', getenv("SYMFONY__DB_NAME"));
  $container->setParameter('database_user', getenv("SYMFONY__DB_USER"));
  $container->setParameter('database_password', getenv("SYMFONY__DB_PASSWD"));

  //mailer_host
  $container->setParameter('mailer_transport', 'smtp');
  $container->setParameter('mailer_host', getenv('SYMFONY__EMAIL_HOST'));
  
  $email_encryption=getenv('SYMFONY__EMAIL_ENCRYPTION');
  
  if(!empty($email_encryption))
  {
	  $container->setParameter('mailer_encryption_method', $email_encryption);
  }
  
  $container->setParameter('mailer_port', getenv('SYMFONY__EMAIL_PORT'));
  $container->setParameter('mailer_user', getenv('SYMFONY__EMAIL_PORT'));
  $container->setParameter('mailer_password', getenv('SYMFONY__EMAIL_PASSWORD'));

  //Filesystem parameters

?>
