<?php
/**
*
*/
class Edit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		if ($session_data)
		{
			$this->load->view('layouts/header');
			$this->load->view('view_edit');
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login_form');
			$this->load->view('layouts/footer');
		}
	}

	public function update_user()
	{
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('user-name','Display Name','trim|required');
		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('layouts/header');
			$this->load->view('view_edit');
			$this->load->view('layouts/footer');
		}
		else
		{
			$id = $this->input->post('hiddenValue');
			$name = $this->input->post('user-name');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			
			$result = $this->model_edit->record_exist($id);

				if ($result)
				{
					$update = $this->model_edit->update_record($username, $name, $email, $id);

					if ($update)
					{?>

						<?php
						$data = array(
						'hiddenValue' => $this->input->post('hiddenValue'),
						'display_name' => $this->input->post('user-name'),
						'username'=> $this->input->post('username'),
						'email' => $this->input->post('email')
						);
						echo json_encode($data);
						/*$this->load->view('layouts/header');
						?>
						<div class="alert alert-success" role="alert">Well done! You successfully read this important alert message....</div>
						<?php
						$this->load->view('view_edit');
						$this->load->view('layouts/footer');*/
					}

					else
					{?>
						<div class="alert alert-danger" role="alert">Oh snap! Change a few things up and try submitting again....</div>
						<?php
						$this->load->view('layouts/header');
						$this->load->view('view_edit');
						$this->load->view('layouts/footer');
					}

				}
				else
				{
					echo "Couldn't update database error";
					$this->load->view('layouts/header');
					$this->load->view('view_edit');
					$this->load->view('layouts/footer');
				}

			// }
			/*
			else
			{
				echo $message['msg'] = "Field can not be left empty";

				$this->load->view('layouts/header');
				$this->load->view('view_edit', $message);
				$this->load->view('layouts/footer');
			}*/
		}
	}
}
?>
