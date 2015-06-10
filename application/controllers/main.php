<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('encrypt');
		$this->load->library('grocery_CRUD');
    }
      function index()
       {
         $this->dashboard();
       }

    function dashboard()
    {
        // $this->validate_admin_access();
        $data['title']="Statistical Guide to Life Expectancy in Kenyan Counties";
        $data['user_details']=array('username'=>'Admin','profile_pic'=>'1234.png');
        $data['breadcrumb']='Dashboard';
        $data['sanitation_analysis']=$this->analyse_sanitation();
        $data['additional_js']=array();
        $sanitation_analysis=$this->analyse_sanitation();
        $water_treatment_analysis=$this->analyse_water_treatment();
        $tuberculosis_analysis=$this->analyse_tuberculosis();
        $physician_analysis=$this->analyse_physician_density();
        $malaria_analysis=$this->analyse_malaria_score();
        $counties_life_expectancy_array=array();
        $counties_array=array();
        unset($sanitation_analysis['status']);
        foreach($sanitation_analysis as $k=>$n):
            $water_treatment_analysis_score=$water_treatment_analysis[$k]['water_treatment_score'];
            $final_sanitation_score=($n['open_defecation_score']+$n['sanitation_improvement_score']+$water_treatment_analysis_score)/3;
            $tuberculosis_analysis_score=$tuberculosis_analysis[$k]['analysed_prevalence_score'];
            $county_name=$n['county_name'];
            $county_details=$this->main_model->resolve_county($county_name);
            $county_id=$county_details['county_id'];
            $malaria_analysis_score=$malaria_analysis[$county_id]['malaria_free_score'];
            $analysis_of_freedom_from_common_diseases=($tuberculosis_analysis_score+$malaria_analysis_score)/2;
            $physician_analysis_score=$physician_analysis[$county_id]['analysed_physician_density_score'];
            $life_expectancy_score=($final_sanitation_score+$analysis_of_freedom_from_common_diseases+$physician_analysis_score)/3;
            $counties_array[]=$county_name;
            $counties_life_expectancy_array[]=$life_expectancy_score;
        endforeach;
        $data['counties_life_expectancy_array']=json_encode($counties_life_expectancy_array);
        $data['counties_array']=json_encode($counties_array);
        $this->load->view('dashboard',$data);
    }

    function sanitation()
    {
        // $this->validate_admin_access();
        $data['title']="Score on the Sanitation Level";
        $data['user_details']=array('username'=>'Admin','profile_pic'=>'1234.png');
        $data['breadcrumb']='Sanitation';
        $data['additional_js']=array();
        $sanitation_data_set=$this->analyse_sanitation();
        $water_treatment_data_set=$this->analyse_water_treatment();
        $overall_sanitation_score_plot_array=array();
        $sanitation_improvement_plot_array=array();
        $water_treatment_plot_array=array();
        $counties_array=array();
        $open_defecation_plot_array=array();
        unset($sanitation_data_set['status']);
        foreach($sanitation_data_set as $k=>$n):
            $county_name=$n['county_name'];
            $open_defecation_score=$n['open_defecation_score'];
            $sanitation_improvement_score=$n['sanitation_improvement_score'];
            $county_details=$this->main_model->resolve_county($county_name);
            $county_id=$county_details['county_id'];
            $water_treatment_score=$water_treatment_data_set[$county_id]['water_treatment_score'];
            $overall_score=($sanitation_improvement_score+$water_treatment_score+$open_defecation_score)/3;
            $overall_sanitation_score_plot_array[]=$overall_score;
            $sanitation_improvement_plot_array[]=$sanitation_improvement_score;
            $open_defecation_plot_array[]=$open_defecation_score;
            $water_treatment_plot_array[]=$water_treatment_score;
            $counties_array[]=$county_name;
        endforeach;
        $data['overall_score']=json_encode($overall_sanitation_score_plot_array);
        $data['water_treatment_score']=json_encode($water_treatment_plot_array);
        $data['open_defecation']=json_encode($open_defecation_plot_array);
        $data['sanitation_improvement_score']=json_encode($sanitation_improvement_plot_array);
        $data['counties']=json_encode($counties_array);
        $this->load->view('sanitation',$data);


//        // $this->validate_admin_access();
//        $data['title']="Score on the Sanitation Level";
//        $data['user_details']=array('username'=>'Admin','profile_pic'=>'1234.png');
//        $data['breadcrumb']='Sanitation';
//        $data['additional_js']=array();
//        $data['sanitation_analysis']=$this->analyse_sanitation();
//        $data['water_treatment_analysis']=$this->analyse_water_treatment();
//        $this->load->view('sanitation',$data);
    }

    function diseases()
    {
        // $this->validate_admin_access();
        $data['title']="Score on Safety from Killer Diseases";
        $data['user_details']=array('username'=>'Admin','profile_pic'=>'1234.png');
        $data['breadcrumb']='Common Diseases';
        $data['additional_js']=array();
        $tuberculosis_data_set=$this->analyse_tuberculosis();
        $malaria_data_set=$this->analyse_malaria_score();
        $freedom_from_killer_diseases_plot_array=array();
        $malaria_plot_array=array();
        $tuberculosis_plot_array=array();
        $counties_array=array();
        unset($tuberculosis_data_set['status']);
        foreach($tuberculosis_data_set as $k=>$n):
            $county_name=$n['county_name'];
            $tuberculosis_score=$n['analysed_prevalence_score'];
            $county_details=$this->main_model->resolve_county($county_name);
            $county_id=$county_details['county_id'];
            $malaria_score=$malaria_data_set[$county_id]['malaria_free_score'];
            $freedom_from_killer_diseases_score=($malaria_score+$tuberculosis_score)/2;
            $freedom_from_killer_diseases_plot_array[]=$freedom_from_killer_diseases_score;
            $malaria_plot_array[]=$malaria_score;
            $tuberculosis_plot_array[]=$tuberculosis_score;
            $counties_array[]=$county_name;
        endforeach;
        $data['malaria_analysis']=json_encode($malaria_plot_array);
        $data['tuberculosis_analysis']=json_encode($tuberculosis_plot_array);
        $data['killer_diseases_analysis']=json_encode($freedom_from_killer_diseases_plot_array);
        $data['counties']=json_encode($counties_array);
        $this->load->view('diseases',$data);
    }

    function physicians()
    {
        // $this->validate_admin_access();
        $data['title']="Score on Safety based on Physician Density";
        $data['user_details']=array('username'=>'Admin','profile_pic'=>'1234.png');
        $data['breadcrumb']='Physician Density';
        $data['additional_js']=array();
        $physician_density_data_set=$this->analyse_physician_density();
        $physician_density_plot_array=array();
        $counties_array=array();
        unset($physician_density_data_set['status']);
        foreach($physician_density_data_set as $k=>$n):
            $county_name=$n['county_name'];
            $physician_density_score=$n['analysed_physician_density_score'];
            $physician_density_plot_array[]=$physician_density_score;
            $counties_array[]=$county_name;
        endforeach;
        $data['physician_density']=json_encode($physician_density_plot_array);
        $data['counties']=json_encode($counties_array);
        $this->load->view('physicians',$data);
    }


    function get_file($file_path)
    {
        $this->load->library('getcsv');
        $data = $this->getcsv->set_file_path($file_path)->get_csv_array();
        return $data;
    }

    function analyse_sanitation(){ // Improper Sanitation leads to contact of water born diseases which that serves to reduce life expectancy in a county
        // This section analyses the net improvement in sanitation provision in a county and the level of open defecation
        $url=$this->process_file_url("sanitation");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
         array_shift($data_set);
         $data_set=array_filter($data_set);
         $analysed_data_set=array('status'=>1);
         $free_from_open_defecation_score=100;
         foreach($data_set as $n){
             $row=$n[0];
             $row_data=explode(",",$row);
             $county_name=$row_data[0];
             $county_details=$this->main_model->resolve_county($county_name);
             $coverage_improved=trim($row_data[1],'%"');
             $coverage_unimproved=trim($row_data[2],'%"');
             $open_defecation_level=trim($row_data[3],'%"');
             $net_improvement=$coverage_improved-$coverage_unimproved;
             $sanitation_improvement_score=$net_improvement;
             $open_defecation_score=$free_from_open_defecation_score-$open_defecation_level;
             $county_set=array('open_defecation_score'=>$open_defecation_score,'county_name'=>$county_details['county_name'],'sanitation_improvement_score'=>$sanitation_improvement_score);
             $analysed_data_set[$county_details['county_id']]=$county_set;

          }
            return $analysed_data_set;

        }
    }

    function analyse_water_treatment(){ // This section analyses drinking of unsafe water
        // Unsafe/Untreated water leads to water born diseases which is a large contributor to deaths leading to a low life expectancy in a county
        $url=$this->process_file_url("water_treatment");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
            array_shift($data_set);
            $data_set=array_filter($data_set);
            $safe_water_score=100;// Denotes score for a county free from any unsafe water consumption
            $analysed_data_set=array('status'=>1);
            foreach($data_set as $n){
                $row=$n[0];
                $row_data=explode(",",$row);
                $county_name=trim($row_data[1],'"');
                $treatment_status=trim($row_data[2],'"');
                $percentage_of_treatment_status=trim($row_data[6],'"');
                if(trim(strtoupper($treatment_status))=="NO"){
                    $county_details=$this->main_model->resolve_county($county_name);
                    $water_treatment_score=$safe_water_score-$percentage_of_treatment_status;
                    $county_set=array('water_treatment_score'=>$water_treatment_score,'county_name'=>$county_details['county_name']);
                    $analysed_data_set[$county_details['county_id']]=$county_set;
                }
            }
            return $analysed_data_set;
        }
    }

    function analyse_population(){ // This analyses the population in the various counties
        $url=$this->process_file_url("population");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
            $data_set=array_slice($data_set,2,(count($data_set)-3),true);
            $data_set=array_filter($data_set);
            $analysed_data_set=array('status'=>1);
            foreach($data_set as $n){
                $row=$n[0];
                $limit=3;
                $row_data=explode(",", $row, $limit);
                $county_name=trim($row_data[1],'"');
                $population=trim($row_data[2],',"');

                $county_details=$this->main_model->resolve_county($county_name);
                $county_set=array('population'=>$population,'county_name'=>$county_details['county_name']);
                $analysed_data_set[$county_details['county_id']]=$county_set;
            }
            return $analysed_data_set;
        }
    }


    function analyse_tuberculosis(){ // Analyses the Number of Patients having TB in a county per 10000 People
        // Tuberculosis in this case is considered to be one of the diseases that contributes to a large number of death thereby leading to low life expectancy
        $url=$this->process_file_url("tuberculosis");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
            $data_set=array_filter($data_set); // Remove Empty Elements
            $data_set=array_slice($data_set,2,(count($data_set)-3),true);
            foreach($data_set as $k=>$n){
                if(trim($n[0])==",,"){
                    unset($data_set[$k]);
                 }
            }
            $reference_number=10000; // the  reference point for TB  prevalence measure ... TB prevalence is shown for every 10000 people in a county
            $tuberculosis_free_score=100; // A score of a 100 is a TB free Score
            $analysed_data_set=array('status'=>1);
            foreach($data_set as $n){
                $row=$n[0];
                $row_data=explode(",",$row);
                $county_name=trim($row_data[1],'"');
                $prevalence=trim($row_data[2],'"');
                $county_details=$this->main_model->resolve_county($county_name);
                $county_id=$county_details['county_id'];
                $prevalence_level=($prevalence/$reference_number)*100;
                $analysed_prevalence_score=$tuberculosis_free_score-$prevalence_level;
                $county_set=array('analysed_prevalence_score'=>$analysed_prevalence_score,'county_name'=>$county_details['county_name']);
                $analysed_data_set[$county_id]=$county_set;
            }
            return $analysed_data_set;
        }
    }

    function analyse_physician_density(){ // Analyses the Number of physicians in a county per 10000 People
        // Physicians are medical doctors  including generalist and specialist medical practitioners
        $url=$this->process_file_url("physician");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
            $data_set=array_filter($data_set); // Remove Empty Elements
            $data_set=array_slice($data_set,2,(count($data_set)-2),true);
            $reference_number=10000; // the  reference point for Physician Density analysis ... The physician density provided is for every 10000 People in a county
            $national_average=18;    // This is the national average of physicians density required for each county .... Retrieved from the Same Physician Density  file
            $analysed_data_set=array('status'=>1);
            foreach($data_set as $n){
                $row=$n[0];
                $row_data=explode(",",$row);
                $county_name=trim($row_data[1],'"');
                $physician_density=trim($row_data[2],'"');
                $county_details=$this->main_model->resolve_county($county_name);
                $county_id=$county_details['county_id'];
                $physician_density_score=($physician_density/$national_average)*100;
                $county_set=array('analysed_physician_density_score'=>$physician_density_score,'county_name'=>$county_details['county_name']);
                $analysed_data_set[$county_id]=$county_set;
            }
            return $analysed_data_set;
        }
    }

    function analyse_malaria_score(){ // Analyses the score of a county of being free from Malaria and related Fevers
        $url=$this->process_file_url("malaria");
        $data_set=$this->get_file($url);
        if($data_set==-1){
            return array('status'=>-1);
        }
        else {
            $data_set=array_filter($data_set); // Remove Empty Elements
            array_shift($data_set);
            $analysed_data_set=array('status'=>1);
            foreach($data_set as $n){
                $row=$n[0];
                $row_data=explode(",",$row);
                $county_name=trim($row_data[0],'%"');
                $bed_net_usage=trim($row_data[1],'%"');
                $malaria_level=trim($row_data[2],'%"'); // This column is generalized to be the level of malaria in a county
                $county_details=$this->main_model->resolve_county($county_name);
                $county_id=$county_details['county_id'];
                $bed_net_usage_score=100-$bed_net_usage;
                $malaria_level_score=100-$malaria_level;
                $malaria_free_score=($bed_net_usage_score+$malaria_level_score)/2;
                $county_set=array('malaria_free_score'=>$malaria_free_score,'county_name'=>$county_details['county_name']);
                $analysed_data_set[$county_id]=$county_set;
            }
            return $analysed_data_set;
        }
    }

    function get_county_population($county_id){
        $county_populations=$this->analyse_population();
        if($county_populations['status']==1){
            return $county_populations[$county_id]['population'];
        }
        else {
            return -1;
        }
    }

    function process_file_url($data_set){
        if($data_set=="population"){
            $url="http://data.hdx.rwlabs.org/dataset/kenya-population-totals-per-county/resource_download/895287eb-4a0e-4ce8-8bbb-f97e7c217df3";
        }
        elseif($data_set=="water_treatment"){
            $url="http://www.majidata.go.ke/dataset_dl.php?meza=H_County_WaterSupply_DrkTrt";
        }
        elseif($data_set=="sanitation"){
            $url="https://www.opendata.go.ke/api/views/mt49-mh8a/rows.csv?accessType=DOWNLOAD";
        }
        elseif($data_set=="physician"){
            $url="http://data.hdx.rwlabs.org/dataset/physicians-density-in-kenya-per-county/resource_download/90bb4dac-8086-4bd4-b50d-341cc955e7f5";
        }
        elseif($data_set=="tuberculosis"){
            $url="http://data.hdx.rwlabs.org/dataset/kenya-tuberculosis-prevalence-per-county/resource_download/573f09bd-084f-4e51-8936-8a40048b7c94";
        }
        elseif($data_set=="malaria"){
            $url="https://www.opendata.go.ke/api/views/akug-z4w2/rows.csv?accessType=DOWNLOAD";
        }
        else{
            $url="-1";
        }
        return $url;
    }

    function test(){
        $data=$this->analyse_tuberculosis();
        print_r($data);
    }

    function sign_in(){
        $data['title']="Sign In";
        $this->load->view('login',$data);
    }
    function log_in(){
        // Authenticate User
        $this->form_validation->set_rules('user_name', 'Email/User ID', 'trim|valid_email|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[6]|max_length[50]');
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div style="color: red;" class="error">', '</div>');
            $this->sign_in();
        }
        else
        {
            $u_pass= $this->input->post('user_pass',TRUE);
            $u_mail= $this->input->post('user_name',TRUE);

            $authentication_result=$this->main_model->authenticate_user($u_mail,$u_pass);
            if($authentication_result['status']==1){
                $this->session->set_userdata($authentication_result['user_data']);
                redirect(base_url().'main/dashboard/');
            }
            else {
                $message="Sign In Failed, ".$authentication_result['message'];
                $this->session->set_flashdata('custom_message', $message);
                $this->sign_in();
            }
        }
    }
    function sign_out(){
        session_destroy();
        redirect(base_url());
    }
    function validate_admin_access(){
        if(!$this->session->has_userdata('logged')){
            $message='You have to be Signed In as Admin to View the requested page';
            $this->session->set_flashdata('custom_message', $message);
            redirect(base_url().'main/sign_in');
        }
        elseif($this->session->logged == TRUE){
            return true;
        }
        else {
            $message='You have to be Signed In to View the requested page';
            $this->session->set_flashdata('custom_message', $message);
            redirect(base_url().'main/sign_in');
        }
    }

 }