<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Individual_plan extends CI_Controller
{
    public $limit = 5;

    public function __construct()
    {
        parent::__construct();
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login');
            exit;
        }
        $this->load->model('individual_plan_model', 'plan');
        $this->load->model('sounds_model', 'sounds');
    }

    public function search()
    {
        $data['plans'] = $this->plan->search($this->input->get('q'));
        $data['pagination'] = '';
        $view['title'] = 'Индивидуальный план развития';
        $this->load->view('header', $view);
        $this->load->view('individual_plan/index', $data);
        $this->load->view('footer');
    }

    public function ajax_search()
    {
        $data['children'] = $this->plan->ajax_search($this->input->get('q'));
        $data['controller'] = 'individual_plan';
        $this->load->view('ajax_search', $data);
    }

    public function index()
    {
        $config = [
            'base_url'         => '/individual_plan/index/',
            'total_rows'       => $this->plan->count(),
            'per_page'         => $this->limit,
            'use_page_numbers' => TRUE
        ];
        $this->pagination->initialize($config);

        $data['plans'] = $this->plan->get_added_children($this->limit);
        $data['pagination'] = $this->pagination->create_links();
        $view['title'] = 'Индивидуальный план развития';
        $this->load->view('header', $view);
        $this->load->view('individual_plan/index', $data);
        $this->load->view('footer');

    }

    public function create()
    {
        if ($this->form_validation->run('individual_plan') == FALSE)
        {
            $data['children'] = $this->plan->get_not_added_children();
            $data['sounds'] = $this->sounds->get_plan_sounds();
            $view['title'] = 'Создание - Индивидуальный план работы';
            $this->load->view('header', $view);
            $this->load->view('individual_plan/add', $data);
            $this->load->view('footer');

        }
        else
        {
            $sounds = $this->plan->prepare_addition($this->input->post());
            $insert_id = $this->plan->create($this->plan->plan_data);

            foreach ($sounds as &$item) {
                $item['individual_plan_id'] = $insert_id;
            }

            if ($this->plan->insert_sounds($sounds))
            {
                header('Location: /individual_plan');
                exit;
            }
        }
    }

    public function edit($id)
    {
        if ($this->form_validation->run('individual_plan') == FALSE)
        {
            $tmp = $this->plan->get_one($id);
            $data['plan'] = $this->plan->convert_data_row($tmp);
            $data['sounds'] = $this->sounds->get_plan_sounds();
            $view['title'] = 'Редактирование - Индивидуальный план работы';
            $this->load->view('header', $view);
            $this->load->view('individual_plan/edit', $data);
            $this->load->view('footer');

        }
        else
        {
            $sounds = $this->plan->prepare_addition($this->input->post());
            $this->plan->edit($this->plan->plan_id, $this->plan->plan_data);

            if ($this->plan->edit_sounds($this->plan->plan_id, $sounds))
            {
                header('Location: /individual_plan/');
                exit;
            }
        }
    }

    public function delete($id)
    {
        if ($this->plan->delete($id))
        {
            header('Location: /individual_plan/');
            exit;
        }
    }

    public function report()
    {
        $tmp = $this->plan->get_one($id);
        $data['plan'] = $this->plan->convert_data_row($tmp);
        $data['sounds'] = $this->sounds->get_plan_sounds();
    }

}