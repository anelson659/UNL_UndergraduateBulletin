<?php

if (file_exists(dirname(__FILE__).'/../config.inc.php')) {
    include_once dirname(__FILE__).'/../config.inc.php';
} else {
    include_once dirname(__FILE__).'/../config.sample.php';
}
iconv_set_encoding("internal_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");

UNL_Services_CourseApproval::setCachingService(new UNL_Services_CourseApproval_CachingService_Null());
UNL_Services_CourseApproval::setXCRIService(new UNL_UndergraduateBulletin_CourseDataDriver());

$controller = new UNL_UndergraduateBulletin_Controller(UNL_UndergraduateBulletin_Router::getRoute() + $_GET);

$outputcontroller = new UNL_UndergraduateBulletin_OutputController();
$outputcontroller->setTemplatePath(dirname(__FILE__).'/templates/html');

switch($controller->options['format']) {
    case 'xml':
        header('Content-type:text/xml');
        $outputcontroller->addTemplatePath(dirname(__FILE__).'/templates/xml');
        break;
    case 'json':
        //header('Content-type: text/javascript');
        $outputcontroller->addTemplatePath(dirname(__FILE__).'/templates/json');
        break;
}
$outputcontroller->setClassToTemplateMapper(new UNL_UndergraduateBulletin_ClassToTemplateMapper());

$outputcontroller->setEscape('htmlentities');
$outputcontroller->addFilters(array($controller, 'postRun'));
echo $outputcontroller->render($controller);

