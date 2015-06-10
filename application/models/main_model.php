<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Africa/Nairobi');
class Main_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    function tables(){
        $tables=array(
            'users'=>'users',
            'misc'=>'misc',
            'counties'=>'counties',
            'db_prefix'=>'rx561uxzsap_'
                     );
        return $tables;
    }

    function get_county_id($county_name){

    }
    function resolve_county($county_name){
        $tables=$this->tables();
        $county_name=strtoupper(trim($county_name));
        if(strpos($county_name,"-")){
            $county_name=str_replace("-"," ",$county_name);
        }
        elseif(strpos($county_name,"/")){
            $county_name=str_replace("/"," ",$county_name);
        }
        $county_name = preg_replace('/\s+/', ' ',$county_name);
        $county_name=$this->resolve_selected_counties($county_name);
        $query = $this->db->get_where($tables['counties'],array('county_name'=>$county_name),1,0);
        $entries= $query->num_rows();
        if($entries==1){
            $county_details=$query->row_array();
            return $county_details;
        }
        else {
            return array('county_id'=>"-1",'county_name'=>'Unknown','provided_name'=>$county_name);
        }
    }
    function resolve_selected_counties($county_name){
        if($county_name=="MURANGA"){
            return "MURANG'A";
        }
        elseif($county_name=="ELGEYO MARAKWET"){
            return "ELGEIYO MARAKWET";
        }
        else{
            return $county_name;
        }
    }

    function authenticate_user($email,$pass){
        $tables=$this->tables();
        $query = $this->db->get_where($tables['users'], array('email' => $email), 1, 0);
        $entries= $query->num_rows();
        if($entries > 0){
            $row=$query->result_array();
            $row=$row[0];
            $Blowfish_Pre = '$2a$05$';
            $Blowfish_End = '$';
            $hashed_pass = crypt($pass, $Blowfish_Pre . $row['kech'] . $Blowfish_End);
            if ($hashed_pass == $row['sap'])
                {
                 $user_data=$row;
                 unset($user_data['sap'],$user_data['kech']);
                 $user_data['logged']=TRUE;
                 $user_data['session_url']=base_url();
                 return array('status'=>1,'user_data'=>$user_data,'message'=>'Successful Login');
                }
             else
              {
                return array('status'=>0,'message'=>'Wrong Username/Password Combination'); // Wrong password
              }
            }
        else
            {
            return array('status'=>-1,'message'=>'Wrong Username/Password Combination'); // No User with Such Email or User ID Exist
            }
     }

    function compute_unique_id($table){
        $prefix=rand (0 , 9999);
        $suffix=rand (0 , 9999);
        $count=$this->db->count_all_results($table);
        $id="$prefix$count$suffix";
        return $id;
    }

    function generate_credentials($password){
        $Allowed_Chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
        $Chars_Len = 50;
        $Salt_Length = 21;
        $salt = "";
        $Blowfish_Pre = '$2a$05$';
        $Blowfish_End = '$';
        for($i=0; $i<$Salt_Length; $i++)
        {
            $salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
        }
        $bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
        $hashed_password = crypt($password, $bcrypt_salt);
        return array($salt,$hashed_password);
    }
    function model_tester(){
       return $this->generate_credentials('admin1234');
    }

}
                            