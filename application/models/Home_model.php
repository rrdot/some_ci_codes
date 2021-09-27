<?php 

class Home_model extends CI_Model
{
	function addpatient()
	{
		$ar['user_id'] = $this->session->userdata('user_id');		
		$a = $this->db->select('room_id')->where('room' , $this->input->post('room'))->get('rooms');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$ar['room_id'] = $abc->room_id;
			}};
		$b = $this->db->select('device_id')->where('device' , $this->input->post('device'))->get('devices');
		if($b->num_rows() > 0){
			foreach ($b->result() as $bcd) {
				$ar['device_id'] = $bcd->device_id;
			}};
		$this->db->insert('monitoring',$ar);
		//$data['monitoring_id'] = $this->db->insert_id();
		//$this->session->set_userdata($data);
		$monitoring_id = $this->db->insert_id();
		return $monitoring_id;

		$arr['name'] = $this->input->post('name');
		$arr['address'] = $this->input->post('address');
		$arr['diagnosis'] = $this->input->post('diagnosis');
		$c = $this->db->select('monitoring_id')->where('room_id' , $abc->room_id)->where('device_id' , $bcd->device_id)
			->get('monitoring');
		if($c->num_rows() > 0){
			foreach ($c->result() as $cde) {
				$arr['monitoring_id'] = $cde->monitoring_id;
			}};
		$this->db->insert('patients',$arr);

		$this->db->set('r_availability', 'Occupied')->where('room_id',$abc->room_id);
		$this->db->update('rooms');

		$this->db->set('d_availability', 'Used')->where('device_id',$bcd->device_id);
		$this->db->update('devices');
	}
	function addroom()
	{
		$arr['room'] = $this->input->post('room');
		$this->db->insert('rooms',$arr);
	}
	function adddevice()
	{
		$arr['device'] = $this->input->post('device');
		$this->db->insert('devices',$arr);
	}
	function avail_rooms()
	{
		$query = $this->db->get_where('rooms', array('r_availability' => 'Available'));
		return $query;
	}
	function avail_devices()
	{
		$query = $this->db->get_where('devices', array('d_availability' => 'Available'));
		return $query;
	}
	function get_patients()
	{
		$this->db->select('monitoring.monitoring_id,patients.patient_id, patients.name,patients.address,patients.diagnosis,rooms.room,devices.device');
		$this->db->from('monitoring');
		$this->db->join('patients', 'monitoring.monitoring_id=patients.monitoring_id');
		$this->db->join('rooms', 'monitoring.room_id=rooms.room_id');
		$this->db->join('devices', 'monitoring.device_id=devices.device_id');
		$this->db->order_by('monitoring_id DESC');
		$query = $this->db->get();
		return $query;
	}
	function get_rooms()
	{
		$this->db->order_by('room_id DESC');
		$query = $this->db->get('rooms');
		return $query;
	}
	function get_users()
	{
		$this->db->order_by('user_id DESC');
		$query = $this->db->get('users');
		return $query;
	}
	function get_devices()
	{
		$this->db->order_by('device_id DESC');
		$query = $this->db->get('devices');
		return $query;
	}
	function get_vitalsigns()
	{
		$this->db->select('monitoring.* , patients.* , vitalsigns.*');
		$this->db->order_by('monitoring.monitoring_id DESC');
		$this->db->group_by('monitoring.monitoring_id'); 
		$this->db->from('monitoring');
		$this->db->join('patients', 'monitoring.monitoring_id=patients.monitoring_id');
		$this->db->join('vitalsigns', 'monitoring.monitoring_id=vitalsigns.monitoring_id');
		$query = $this->db->get();
		return $query;

		/*
		$this->db->select("monitoring.*, patients.*, vitalsigns.* FROM monitoring 
			INNER JOIN (SELECT vitalsigns.* FROM vitalsigns 
					GROUP BY vitalsigns.monitoring_id
					ORDER BY vs_id DESC) vitalsigns ON monitoring.monitoring_id = vitalsigns.monitoring_id
			INNER JOIN patients ON monitoring.monitoring_id = patients.monitoring_id");
		$this->db->order_by('monitoring.monitoring_id DESC');
		$query = $this->db->get();
		return $query;
		*/

	}
	function getHistorybyId($monitoring_id)
	{
		$this->db->select('*');
		$this->db->from('vitalsigns');
		$this->db->where('monitoring_id', $monitoring_id);
		$this->db->order_by('vs_id DESC');
		$query = $this->db->get();
		return $query;
	}
	function getPatientId($monitoring_id)
	{
		return $this->db->get_where('patients',array('monitoring_id'=>$monitoring_id))->row();
	}
	function getSelectedRoom($monitoring_id)
	{
		$a = $this->db->select('room_id')->where('monitoring_id',$monitoring_id)->get('monitoring');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$room_id = $abc->room_id;
			}
		}
		return $this->db->get_where('rooms',array('room_id'=>$room_id))->row();
	}
	function getSelectedDevice($monitoring_id)
	{
		$a = $this->db->select('device_id')->where('monitoring_id',$monitoring_id)->get('monitoring');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$device_id = $abc->device_id;
			}
		}
		return $this->db->get_where('devices',array('device_id'=>$device_id))->row();
	}
	function updatepatient($monitoring_id)
	{
		$arr['name'] = $this->input->post('name');
		$arr['address'] = $this->input->post('address');
		$arr['diagnosis'] = $this->input->post('diagnosis');
		$this->db->where(array('monitoring_id'=>$monitoring_id));
		$this->db->update('patients',$arr);

		$a = $this->db->select('room_id, device_id')->where('monitoring_id' , $monitoring_id)->get('monitoring');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$old_room = $abc->room_id;
				$old_device = $abc->device_id;
			}
		}
		$b = $this->db->select('room_id')->where('room',$this->input->post('room'))->get('rooms');
		if($b->num_rows() > 0){
			foreach ($b->result() as $bcd) {
				$new_room = $bcd->room_id;
			}
			if ($old_room != $new_room) {
				$this->db->set('room_id', $new_room)->where('monitoring_id',$monitoring_id);
				$this->db->update('monitoring');

				$this->db->set('r_availability', 'Occupied')->where('room_id',$new_room);
				$this->db->update('rooms');

				$this->db->set('r_availability', 'Available')->where('room_id',$old_room);
				$this->db->update('rooms');
			}
		}

		$c = $this->db->select('device_id')->where('device',$this->input->post('device'))->get('devices');
		if($c->num_rows() > 0){
			foreach ($c->result() as $cde) {
				$new_device = $cde->device_id;
			}
			if ($old_device != $new_device) {
				$this->db->set('device_id', $new_device)->where('monitoring_id',$monitoring_id);
				$this->db->update('monitoring');

				$this->db->set('d_availability', 'Used')->where('device_id',$new_device);
				$this->db->update('devices');

				$this->db->set('d_availability', 'Available')->where('device_id',$old_device);
				$this->db->update('devices');
			}
		}
	}
	function getRoomId($room_id)
	{
		return $this->db->get_where('rooms',array('room_id'=>$room_id))->row();
	}
	function updateroom($room_id)
	{
		$arr['room'] = $this->input->post('room');
		$this->db->where(array('room_id'=>$room_id));
		$this->db->update('rooms',$arr);
	}
	function getDeviceId($device_id)
	{
		return $this->db->get_where('devices',array('device_id'=>$device_id))->row();
	}
	function updatedevice($device_id)
	{
		$arr['device'] = $this->input->post('device');
		$this->db->where(array('device_id'=>$device_id));
		$this->db->update('devices',$arr);
	}
	function deleteuser($user_id)
	{
		$this->db->where(array('user_id'=>$user_id));
		$this->db->delete('users');
	}
	function deletepatient($monitoring_id)
	{
		$a = $this->db->select('*')->where('monitoring_id',$monitoring_id)->get('monitoring');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$this->db->set('r_availability', 'Available')->where('room_id',$abc->room_id);
				$this->db->update('rooms');
				$this->db->set('d_availability', 'Available')->where('device_id',$abc->device_id);
				$this->db->update('devices');
		}};
		$this->db->where(array('monitoring_id'=>$monitoring_id));
		$this->db->delete('patients');
		$this->db->where(array('monitoring_id'=>$monitoring_id));
		$this->db->delete('monitoring');
	}
	function deleteroom($room_id)
	{
		$this->db->where(array('room_id'=>$room_id));
		$this->db->delete('rooms');
	}
	function deletedevice($device_id)
	{
		$this->db->where(array('device_id'=>$device_id));
		$this->db->delete('devices');
	}
	function roomcheck($room_id){
		$a = $this->db->select('r_availability')->where('room_id',$room_id)->get('rooms');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$check = $abc->r_availability;
			}
			return $check;
		};
	}
	function devicecheck($device_id){
		$a = $this->db->select('d_availability')->where('device_id',$device_id)->get('devices');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$check = $abc->d_availability;
			}
			return $check;
		};
	}
	function get_patientName($monitoring_id)
	{
		$a = $this->db->select('name')->where('monitoring_id',$monitoring_id)->get('patients');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$name = $abc->name;
				$name = str_replace(' ', '', $name);
			}
		return $name;
		}
	}
	function print_patientReport($monitoring_id)
	{
		$a = $this->db->select('name')->where('monitoring_id',$monitoring_id)->get('patients');
		if($a->num_rows() > 0){
			foreach ($a->result() as $abc) {
				$patientname = $abc->name;
			}
		}
		//$this->db->where('monitoring_id', $monitoring_id);
		$data = $this->db->select('*')->where('monitoring_id',$monitoring_id)->order_by('vs_id DESC')->get('vitalsigns');
		$output = '<h4>Patient Name : '.$patientname.'</h4><table width="100%" border="1" cellspacing="5" cellpadding="5">';
		
			$output .= '
			<tr>
				<th width = "25%" style="text-align: center; vertical-align: middle;">O2 SAT (%)</th>
          		<th width = "25%" style="text-align: center; vertical-align: middle;">Pulse Rate</th>
          		<th width = "25%" style="text-align: center; vertical-align: middle;">Temperature (°C)</th>
          		<th width = "25%" style="text-align: center; vertical-align: middle;">Date/Time</th>
			</tr>';
			foreach($data->result() as $row)
			{
			$output .= '	
			<tr>
				<td width = "25%" style="text-align: center; vertical-align: middle;">'.$row->o2_sat. '</td>
				<td width = "25%" style="text-align: center; vertical-align: middle;">'.$row->pulse_rate. '</td>
				<td width = "25%" style="text-align: center; vertical-align: middle;">'.$row->temperature. '</td>
				<td width = "25%" style="text-align: center; vertical-align: middle;">'.$row->datetime. '</td>
			</tr>
			';
			}
		$output .= '</table>';
		return $output;
	}
	function set_interval()
	{
		$monitoring_id = $this->input->post('my_id');
		$arr['intrvl'] = $this->input->post('interval_value');
		$this->db->where(array('monitoring_id'=>$monitoring_id));
		$this->db->update('monitoring',$arr);
	}





}
?>