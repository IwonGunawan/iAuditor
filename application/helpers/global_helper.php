<?php

	function is_login()
	{
		$ci 	= get_instance();

		$users_level 	= $ci->session->userdata("users_level");
		$menu_current = $ci->uri->segment(1);
		$menu_bumdes 	= array(
									"reports",
									"farmers_penyaluran", 
									"farmers_pengembalian",  
									"bumdes_penyaluran", 
									"bumdes_pengembalian", 
									"maps", 
								);

		
		if ($users_level == "" || $users_level == null) 
		{
			$ci->session->set_flashdata("error", "No Access, please login");
	    redirect(base_url("logout"));
		}
		else
		{
			if ($users_level == config("LEVEL_BUMDES")) 
			{
				$index 	= array_search($menu_current, $menu_bumdes);
				if ($menu_current !== $menu_bumdes[$index] && $ci->uri->segment(2) !== "changePass") 
				{
					redirect(base_url("404"));
				}
			}
		}
	}

	function get_session($type="")
	{
		$ci 	= get_instance();

		$result 	= array(
							'id'        => $ci->session->userdata("users_id"), 
		          'name'      => $ci->session->userdata("users_name"),
		          'email'     => $ci->session->userdata("users_email"), 
		          'level'     => $ci->session->userdata("users_level"),  
		          'status'    => $ci->session->userdata("users_status"), 
							);


		return $result[$type];
	}

	function menu_active($menu="")
	{
		$ci	= get_instance();

		if ($menu !== "") 
		{
			$uri1 	= $ci->uri->segment(1);
			$uri2 	= $ci->uri->segment(2);
			if ($uri1.'/'.$uri2 == $menu) 
			{
				return "active";
			}
			else if ($uri1 == $menu) 
			{
				return "active";
			}

		}

		return "";
	}