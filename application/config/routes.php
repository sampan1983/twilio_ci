<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['Contacts'] = 'Clients';
$route['Single_Message'] = 'Single_message';
$route['Bulk_Message'] = 'Bulk_sms';
$route['Inbox'] = 'Received_messages_new';

$route['Sent_Messages'] = 'Sent_messages';
$route['Voice_Broadcast'] = 'Outgoing_calls';
$route['Bulk_Voice_Broadcast'] = 'Voice_broadcast';
$route['Single_Mail'] = 'Single_mail';
$route['Bulk_Mail'] = 'Bulk_mail';
$route['Mail_Outbox'] = 'Sent_mail';


$route['Bulk_Fax'] = 'Bulk_fax';
$route['Fax_Inbox'] = 'Fax_inbox';
$route['Fax_Outbox'] = 'Sent_fax';
$route['Groups'] = 'Add_group_numbers';
$route['Template_Messages'] = 'Templates';
$route['Blacklist'] = 'Blacklist_numbers';

$route['Autoresponder_Keywords'] = 'Keywords';
$route['Call_Logs'] = 'Outgoing_call_logs';
$route['Queued_Calls'] = 'Pending_calls';
$route['Queued_Mails'] = 'Queued_mails';
$route['Failed_Fax'] = 'Failed_fax';
$route['Pending_Fax'] = 'Pending_fax';
$route['Failed_Messages'] = 'Failed_numbers';
$route['Pending_Messages'] = 'Pending_numbers';
$route['Add_Account'] = 'Add_twilio_account';
$route['Add_Number'] = 'Add_twilio_number';

$route['My_Profile'] = 'User_list';
$route['Messages'] = 'Received_messages';
$route['Group_Numbers'] ='View_group_number';

$route['Receieved_messages/export/(:any),(:any),(:any)'] = 'Receieved_messages/export/$1/$2/$3';
$route['Sent_messages/export/(:any)'] = 'Sent_messages/export/$1';

$route['Queued'] = 'Pending_numbers/Queued';
$route['ivr_setting'] = 'Ivr_setting';
$route['record'] = "Bulk_call/record";
$route['gather/(:any)'] = "Bulk_call/gather/$1";
$route['process_gather'] = "Bulk_call/process_gather";
$route['ivr_delete'] = "Ivr_setting/ivr_delete";
$route['add_ivr'] = "Ivr_setting/add_ivr_new";
$route['ivr_edit'] = "Ivr_setting/ivr_edit";
$route['Reccuring'] = "Recurring_msgs";
$route['add_recurring_data'] = "Recurring_msgs/add_recurring_data";
$route['send_recurring'] = "Recurring_msg/recurring_data_send";
$route['recurr_delete'] = "Recurring_msgs/delete";
$route['recurr_edit'] = "Recurring_msgs/edit";
$route['stop_recurr'] = "Recurring_msgs/stop_recurr";
$route['forward_calling'] = 'Ivr/forward_calling';
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
