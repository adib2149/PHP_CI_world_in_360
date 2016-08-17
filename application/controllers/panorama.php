<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panorama extends CI_Controller {

	public function index($image_index)
	{
		$result = $this->_getData($image_index);
		$json = json_decode($result, true);
		$data['data'] = $json;

		if ($json == null || $json == '') {
			$this->output->set_status_header('404');
			$this->load->view('custom_404');
		} else {
			
			$this->load->view('view_panorama', $data);
		}
	}

	public function _getData($image_index) {
		$url = 'https://world-in-360.firebaseio.com/imagename/'.$image_index.'.json';

        // Open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute post
        $result = curl_exec($ch);
        if ($result == FALSE) {
            die('Curl failed: ' . curl_error($ch));
            return null;
        }
 
        // Close connection
        curl_close($ch);

        return $result;
	}

}