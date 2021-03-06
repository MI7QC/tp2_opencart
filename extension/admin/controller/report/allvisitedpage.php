<?php
class ControllerReportAllvisitedpage extends Controller {
	private $error = array();
		
	/**
	 * Envoit les données à la vue du rapport "All visited pages"
	 * @return void
	 */
	public function index() {

		$this->load->language('report/allvisitedpage');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_visited_id'] = $this->language->get('text_visited_id');
        $data['text_url'] = $this->language->get('text_url');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_ip_address'] = $this->language->get('text_ip_address');
        $data['text_user_id'] = $this->language->get('text_user_id');
       
		
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('report/allvisitedpage');

		$data['breadcrumbs'] = array();

        $all_visited = $this->model_report_allvisitedpage->getAllVisitedPage();
		
		$data['all_visited'] = array();
				foreach ($all_visited as $visited) {
					$data['all_visited'][] = array(
						'visited_id' => $visited['visited_id'],
						'url' => $visited['url'],
						'title' => $visited['title'],
						'date' => $visited['date'],
						'ip_address' => $visited['ip_address'],
						'user_id' => $visited['user_id']
					);
				}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('report/allvisitedpage', $data));
	}	
}