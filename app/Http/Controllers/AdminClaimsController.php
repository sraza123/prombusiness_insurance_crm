<?php namespace App\Http\Controllers;

    use Carbon\Carbon;
	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminClaimsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "claims";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Claim Number","name"=>"claim_number"];
			$this->col[] = ["label"=>"Policy #","name"=>"policy_id","join"=>"policies,policy_number"];
			$this->col[] = ["label"=>"Job Type","name"=>"job_type"];
			$this->col[] = ["label"=>"Campaign","name"=>"campaign_id","join"=>"campaign,name"];
			$this->col[] = ["label"=>"Engineer Required","name"=>"engineer_required"];
			$this->col[] = ["label"=>"Engineer","name"=>"engineer_id","join"=>"engineer,Company"];
			$this->col[] = ["label"=>"Claim Status","name"=>"claim_status"];
			$this->col[] = ["label"=>"Job Requested","name"=>"job_requested_date"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Policy Id','name'=>'policy_id','type'=>'datamodal','validation'=>'required|integer|min:1','width'=>'col-sm-10','datamodal_table'=>'policies','datamodal_columns'=>'policy_number,merchant_id,start_date,end_date','datamodal_size'=>'large'];
			$this->form[] = ['label'=>'Job Type','name'=>'job_type','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'New Job;Recall'];
			$this->form[] = ['label'=>'Campaign','name'=>'campaign_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'campaign,name'];
			$this->form[] = ['label'=>'Appliance Claim','name'=>'appliance_claim','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Claim Id','name'=>'claim_id','type'=>'select2','width'=>'col-sm-9','style'=>'display:none'];
			$this->form[] = ['label'=>'Engineer Required','name'=>'engineer_required','type'=>'select','validation'=>'required','width'=>'col-sm-9','dataenum'=>'Yes;No'];
			$this->form[] = ['label'=>'Engineer Id','name'=>'engineer_id','type'=>'datamodal','validation'=>'required|integer|min:0','width'=>'col-sm-10','datamodal_table'=>'engineer','datamodal_columns'=>'Company,Contact,Postal_Code,Business_Phone,Mobile_Number,Areas_Covered,Notes','datamodal_size'=>'large','datamodal_where'=>'Postal_Code != \'\'','style'=>'display:none'];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Claim Status','name'=>'claim_status','type'=>'select','validation'=>'required','width'=>'col-sm-9','dataenum'=>'PENDING;COMPLETED'];
			$this->form[] = ['label'=>'Claim State','name'=>'claim_state','type'=>'select','validation'=>'required','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Claim Notes','name'=>'claim_notes','type'=>'textarea','validation'=>'required','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Job Requested Date','name'=>'job_requested_date','type'=>'date','validation'=>'required','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Appt Date','name'=>'appt_date','type'=>'date','validation'=>'required','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Notes','name'=>'comments','type'=>'textarea','validation'=>'required','width'=>'col-sm-9'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Policy Id','name'=>'policy_id','type'=>'datamodal','validation'=>'required|integer|min:1','width'=>'col-sm-10','datamodal_table'=>'policies','datamodal_columns'=>'policy_number,merchant_id,start_date,end_date','datamodal_size'=>'large'];
			//$this->form[] = ['label'=>'Job Type','name'=>'job_type','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'New Job;Recall'];
			//$this->form[] = ['label'=>'Campaign','name'=>'campaign_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'campaign,name'];
			//$this->form[] = ['label'=>'Appliance Claim','name'=>'appliance_claim','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Claim Id','name'=>'claim_id','type'=>'select2','width'=>'col-sm-9','style'=>'display:none'];
			//$this->form[] = ['label'=>'Engineer Required','name'=>'engineer_required','type'=>'select','validation'=>'required','width'=>'col-sm-9','dataenum'=>'Yes;No'];
			//$this->form[] = ['label'=>'Engineer Id','name'=>'engineer_id','type'=>'datamodal','validation'=>'required|integer|min:0','width'=>'col-sm-10','datamodal_table'=>'engineer','datamodal_columns'=>'Company,Contact,Postal_Code,Business_Phone,Mobile_Number,Areas_Covered,Notes','datamodal_size'=>'large','datamodal_where'=>'Postal_Code != \'\'','style'=>'display:none'];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Claim Status','name'=>'claim_status','type'=>'select','validation'=>'required','width'=>'col-sm-9','dataenum'=>'PENDING;COMPLETED'];
			//$this->form[] = ['label'=>'Claim State','name'=>'claim_state','type'=>'select','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Claim Notes','name'=>'claim_notes','type'=>'textarea','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Job Requested Date','name'=>'job_requested_date','type'=>'date','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Appt Date','name'=>'appt_date','type'=>'date','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Notes','name'=>'comments','type'=>'textarea','validation'=>'required','width'=>'col-sm-9'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        //$this->load_js = array();
            $this->load_js = array(asset("js/claim.js"));
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {

	        if(empty($postdata['claim_id'])) {
                $postdata['claim_id'] = null;
            }
            $dt = Carbon::now();
            $dt = $dt->format('Ymd');

            $claimNumber = $dt;
            $numberOfClaims = DB::table('claims')
                ->whereRaw(DB::raw('DATE(TIMESTAMPADD(HOUR, 4, created_at))'),DB::raw('DATE(TIMESTAMPADD(HOUR, 4, NOW()))'))
                ->min('id');

            $claimNumber .= sprintf('%06d', $numberOfClaims == null ? 1 : $numberOfClaims+1);
            $claimNumber .= 'PB';

            $postdata['claim_number'] = $claimNumber;
            $postdata['claim_status'] = $postdata['claim_status'].'-'.$postdata['claim_state'];

            $postdata['created_by'] = CRUDBooster::myId();

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {

            if(empty($postdata['claim_id'])) {
                $postdata['claim_id'] = null;
            }

            $postdata['claim_status'] = $postdata['claim_status'].'-'.$postdata['claim_state'];

            $postdata['updated_by'] = CRUDBooster::myId();
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}