<html>
<head>
	<style type="text/css">
		table {
			width: 100%;
		}
		table tr td, table tr th {
			padding: 15px;
			border: solid 1px #ccc;
		}
	</style>
</head>
<body style="background: #eee; text-align: center;">
	<h1>HRMS</h1>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Action</th>
				<th>API</th>
				<th>Created Date</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Award List</td>
				<td><a href="<?=site_url('Api/awards?user_id=31')?>" target="_blank"><?=site_url('Api/awards?user_id=31')?></a></td>
				<td>2017-12-19</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Get Profile</td>
				<td><a href="<?=site_url('Api/getprofile?user_id=31')?>" target="_blank"><?=site_url('Api/getprofile?user_id=31')?></a></td>
				<td>2017-12-19</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Add Leave</td>
				<td><a href="<?=site_url('Api/add_leave?user_id=31&from_date=2017-12-10&to_date=2017-12-15&reason=going%20outside&leave_type=1')?>" target="_blank"><?=site_url('Api/add_leave?user_id=31&from_date=2017-12-10&to_date=2017-12-15&reason=going%20outside&leave_type=1')?></a></td>
				<td>2017-12-19</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Remaining Leave</td>
				<td><a href="<?=site_url('Api/remaining_leave?user_id=31')?>" target="_blank"><?=site_url('Api/remaining_leave?user_id=31')?></a></td>
				<td>2017-12-19</td>
			</tr>
			<tr>
				<td>5</td>
				<td>List of Leave</td>
				<td><a href="<?=site_url('Api/list_of_leave?user_id=31')?>" target="_blank"><?=site_url('Api/list_of_leave?user_id=31')?></a></td>
				<td>2017-12-19</td>
			</tr>
			<tr>
				<td>6</td>
				<td>Attendance History</td>
				<td><a href="<?=site_url('Api/attendance_history?user_id=31')?>" target="_blank"><?=site_url('Api/attendance_history?user_id=31')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>7</td>
				<td>Worksheet</td>
				<td><a href="<?=site_url('Api/worksheet_tasks?user_id=10&page=1&search=test')?>" target="_blank"><?=site_url('Api/worksheet_tasks?user_id=10&page=1&search=test')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>8</td>
				<td>Have Work</td>
				<td><a href="<?=site_url('Api/have_work?user_id=1&work=1')?>" target="_blank"><?=site_url('Api/have_work?user_id=1&work=1')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>9</td>
				<td>Project Detail</td>
				<td><a href="<?=site_url('Api/project_detail?project_id=2&user_id=1')?>" target="_blank"><?=site_url('Api/project_detail?project_id=2&user_id=1')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>10</td>
				<td>Add Project Image</td>
				<td><a href="<?=site_url('Api/uploadProjectImage?user_id=1&project_id=1&project_image')?>" target="_blank"><?=site_url('Api/uploadProjectImage?user_id=1&project_id=1&project_image')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>11</td>
				<td>Remove Project Image</td>
				<td><a href="<?=site_url('Api/removeProjectImage?image_id=2')?>" target="_blank"><?=site_url('Api/removeProjectImage?image_id=2')?></a></td>
				<td>2017-12-20</td>
			</tr>
			<tr>
				<td>12</td>
				<td>Project Query</td>
				<td><a href="<?=site_url('Api/projectQuery?user_id=1&project_id=1&query=testing%20query')?>" target="_blank"><?=site_url('Api/projectQuery?user_id=1&project_id=1&query=testing%20query')?></a></td>
				<td>2017-12-21</td>
			</tr>
			<tr>
				<td>13</td>
				<td>File Management</td>
				<td><a href="<?=site_url('Api/file_management?user_id=1&department_id=1&file=asdf')?>" target="_blank"><?=site_url('Api/file_management?user_id=1&department_id=1&file=asdf')?></a></td>
				<td>2017-12-21</td>
			</tr>
			<tr>
				<td>14</td>
				<td>Leave Type</td>
				<td><a href="<?=site_url('Api/leave_type')?>" target="_blank"><?=site_url('Api/leave_type')?></a></td>
				<td>2017-12-21</td>
			</tr>
			<tr>
				<td>15</td>
				<td>Privacy Policy/T&amp;C</td>
				<td><a href="<?=site_url('Api/privacy')?>" target="_blank"><?=site_url('Api/privacy')?></a></td>
				<td>2017-12-22</td>
			</tr>
			<tr>
				<td>16</td>
				<td>Directory</td>
				<td><a href="<?=site_url('Api/directory')?>" target="_blank"><?=site_url('Api/directory')?></a></td>
				<td>2017-12-23</td>
			</tr>
			<tr>
				<td>17</td>
				<td>Current Year Salary</td>
				<td><a href="<?=site_url('Api/salaryDetail?user_id=11&year=current')?>" target="_blank"><?=site_url('Api/salaryDetail?user_id=11&year=current')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>18</td>
				<td>Last Year Salary</td>
				<td><a href="<?=site_url('Api/salaryDetail?user_id=11&year=last')?>" target="_blank"><?=site_url('Api/salaryDetail?user_id=11&year=last')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>19</td>
				<td>Salary Slip</td>
				<td><a href="<?=site_url('Api/getSalarySlip?salary_id=1')?>" target="_blank"><?=site_url('Api/getSalarySlip?salary_id=1')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>20</td>
				<td>Designations</td>
				<td><a href="<?=site_url('Api/designations')?>" target="_blank"><?=site_url('Api/designations')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>21</td>
				<td>Apply For Appraisal</td>
				<td><a href="<?=site_url('Api/applyAppraisal?user_id=1&name=Hemant%20Anjana&designation_id=1&last_appraisal_date=2017-01-01&expected_appraisal_date=2018-01-01&current_salary=10000&expected_salary=25000&promotion=1')?>" target="_blank"><?=site_url('Api/applyAppraisal?user_id=1&name=Hemant%20Anjana&designation_id=1&last_appraisal_date=2017-01-01&expected_appraisal_date=2018-01-01&current_salary=10000&expected_salary=25000&promotion=1')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>22</td>
				<td>Files List</td>
				<td><a href="<?=site_url('Api/files_list?user_id=1')?>" target="_blank"><?=site_url('Api/files_list?user_id=1')?></a></td>
				<td>2017-12-27</td>
			</tr>
			<tr>
				<td>23</td>
				<td>Recuitments</td>
				<td><a href="<?=site_url('Api/recruiments')?>" target="_blank"><?=site_url('Api/recruiments')?></a></td>
				<td>2017-12-28</td>
			</tr>
			<tr>
				<td>24</td>
				<td>Apply Recuitment</td>
				<td><a href="<?=site_url('Api/applyForRecruiment?user_id=1&job_id=1&name=Hemant%20Anjana&email=hemant@infograins.com&phone=7412587418&experience=2%20Year&message=ear Sir/Mam, I am able for this position and please conduct interview&resume=abc.docx')?>" target="_blank"><?=site_url('Api/applyForRecruiment?user_id=1&job_id=1&name=Hemant%20Anjana&email=hemant@infograins.com&phone=7412587418&experience=2%20Year&message=ear Sir/Mam, I am able for this position and please conduct interview&resume=abc.docx')?></a></td>
				<td>2017-12-28</td>
			</tr>
			<tr>
				<td>25</td>
				<td>Email List</td>
				<td><a href="<?=site_url('Api/emailList?user_id=10&search=a')?>" target="_blank"><?=site_url('Api/emailList?user_id=10&search=a')?></a></td>
				<td>2017-12-28</td>
			</tr>
			<tr>
				<td>26</td>
				<td>File Request</td>
				<td><a href="<?=site_url('Api/fileRequest?user_id=10&department_id=1&title=Please%20share%20a%20file')?>" target="_blank"><?=site_url('Api/fileRequest?user_id=10&department_id=1&title=Please%20share%20a%20file')?></a></td>
				<td>2017-12-28</td>
			</tr>
			<tr>
				<td>27</td>
				<td>Departments</td>
				<td><a href="<?=site_url('Api/departments')?>" target="_blank"><?=site_url('Api/departments')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>28</td>
				<td>Performance Monthly</td>
				<td><a href="<?=site_url('Api/performance?user_id=3&performance=monthly')?>" target="_blank"><?=site_url('Api/performance?user_id=3&performance=monthly')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>29</td>
				<td>Performance Quaterly</td>
				<td><a href="<?=site_url('Api/performance?user_id=3&performance=quaterly')?>" target="_blank"><?=site_url('Api/performance?user_id=3&performance=quaterly')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>30</td>
				<td>Performance Yearly</td>
				<td><a href="<?=site_url('Api/performance?user_id=3&performance=yearly')?>" target="_blank"><?=site_url('Api/performance?user_id=3&performance=yearly')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>31</td>
				<td>Traning Upcoming</td>
				<td><a href="<?=site_url('Api/trainings?user_id=3&traning=upcoming')?>" target="_blank"><?=site_url('Api/trainings?user_id=3&traning=upcoming')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>32</td>
				<td>Traning History</td>
				<td><a href="<?=site_url('Api/trainings?user_id=1&traning=previous')?>" target="_blank"><?=site_url('Api/trainings?user_id=1&traning=previous')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>33</td>
				<td>Benefits</td>
				<td><a href="<?=site_url('Api/benefits')?>" target="_blank"><?=site_url('Api/benefits')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>34</td>
				<td>FAQ</td>
				<td><a href="<?=site_url('Api/FAQ')?>" target="_blank"><?=site_url('Api/FAQ')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>35</td>
				<td>Tickets</td>
				<td><a href="<?=site_url('Api/ticketList?user_id=1')?>" target="_blank"><?=site_url('Api/ticketList?user_id=1')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>36</td>
				<td>Add Tickets</td>
				<td><a href="<?=site_url('Api/addTicket?user_id=1&subject=test&priority=2&description=test%20description')?>" target="_blank"><?=site_url('Api/addTicket?user_id=1&subject=test&priority=2&description=test%20description')?></a></td>
				<td>2017-12-29</td>
			</tr>
			<tr>
				<td>37</td>
				<td>Add &amp; Remove Project Images</td>
				<td><a href="<?=site_url('Api/addDeleteProjectFiles?user_id=1&project_id=5&previous_images=2,4&images=new.jpg')?>" target="_blank"><?=site_url('Api/addDeleteProjectFiles?user_id=1&project_id=5&previous_images=2,4&images=new.jpg')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>38</td>
				<td>Warnings</td>
				<td><a href="<?=site_url('Api/warnings?user_id=10')?>" target="_blank"><?=site_url('Api/warnings?user_id=10')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>39</td>
				<td>Office Shifts</td>
				<td><a href="<?=site_url('Api/officeShift?user_id=10')?>" target="_blank"><?=site_url('Api/officeShift?user_id=10')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>40</td>
				<td>Travels</td>
				<td><a href="<?=site_url('Api/travels?user_id=10')?>" target="_blank"><?=site_url('Api/travels?user_id=10')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>41</td>
				<td>Add Travels</td>
				<td><a href="<?=site_url('Api/addTravel?user_id=10&destination=Delhi&purpose=Traning&description=for%20testing&dep_date=2018-01-05&return_date=2018-01-20')?>" target="_blank"><?=site_url('Api/addTravel?user_id=10&destination=Delhi&purpose=Traning&description=for%20testing&dep_date=2018-01-05&return_date=2018-01-20')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>42</td>
				<td>Announcements</td>
				<td><a href="<?=site_url('Api/announcements?user_id=10')?>" target="_blank"><?=site_url('Api/announcements?user_id=10')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>43</td>
				<td>Survey List</td>
				<td><a href="<?=site_url('Api/surveyList')?>" target="_blank"><?=site_url('Api/surveyList')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>44</td>
				<td>Take Survey</td>
				<td><a href="<?=site_url('Api/takeSurvey?user_id=10&survey_id=1')?>" target="_blank"><?=site_url('Api/takeSurvey?user_id=10&survey_id=1')?></a></td>
				<td>2017-12-30</td>
			</tr>
			<tr>
				<td>45</td>
				<td>Edit Health</td>
				<td><a href="<?=site_url('Api/editHealth?user_id=10&blood_group=A+&height=5.11&weight=50&disease=none')?>" target="_blank"><?=site_url('Api/editHealth?user_id=10&blood_group=A+&height=5.11&weight=50&disease=none')?></a></td>
				<td>2017-01-03</td>
			</tr>
			<tr>
				<td>45</td>
				<td>Medical Convocation</td>
				<td><a href="<?=site_url('Api/medicalConvocation?user_id=10')?>" target="_blank"><?=site_url('Api/medicalConvocation?user_id=10')?></a></td>
				<td>2017-01-03</td>
			</tr>
			<tr>
				<td>46</td>
				<td>Medical Request</td>
				<td><a href="<?=site_url('Api/MedicalConvocationRequest?user_id=10')?>" target="_blank"><?=site_url('Api/MedicalConvocationRequest?user_id=10')?></a></td>
				<td>2017-01-03</td>
			</tr>
			<tr>
				<td>47</td>
				<td>Feedback</td>
				<td><a href="<?=site_url('Api/feedback?user_id=10&answers=answer1,answer2,answer3,answer4,answer5&message=Hello%20this%20is%20test%20content')?>" target="_blank"><?=site_url('Api/feedback?user_id=10&answers=answer1,answer2,answer3,answer4,answer5&message=Hello%20this%20is%20test%20content')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
			<td colspan="4" style="text-align: left;"><b>UPDATED AND NEW API LIST</b></td>
			</tr>

			<tr>
				<td>1</td>
				<td>Addticket</td>
				<td><a href="<?=site_url('Api/addTicket?user_id=49&company_id=17&subject=problem&priority=2&description=this%20is%20test')?>" target="_blank"><?=site_url('Api/addTicket?user_id=49&company_id=17&subject=problem&priority=2&description=this%20is%20test')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
				<td>2</td>
				<td>ticketList</td>
				<td><a href="<?=site_url('Api/ticketList?user_id=49&company_id=17')?>" target="_blank"><?=site_url('Api/ticketList?user_id=49&company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
				<td>3</td>
				<td>get employee under user</td>
				<td><a href="<?=site_url('Api/getUnderEmp?user_id=4')?>" target="_blank"><?=site_url('Api/getUnderEmp?user_id=4')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>4</td>
				<td>get employee under user with search</td>
				<td><a href="<?=site_url('Api/getUnderEmp?user_id=4&search=khus')?>" target="_blank"><?=site_url('Api/getUnderEmp?user_id=4&search=khus')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>5</td>
				<td>Update profile</td>
				<td><a href="<?=site_url('Api/updateEmployeProfile?user_id=43&first_name=shilpa&email=kripa@infograins.com&date_of_birth=2017-12-01&marital_status=Married&last_name=agrwal&address=Indore&contact_no=2589635&emergency_contact_name=ritika&emergency_contact_number=1234567890&city_of_birth=Indore&country_of_birth=ndia&address_two=Lane%202%20India&telephone=102121544&email_two=archana@infograins.com&nsn=4654654546545656456564&spouse_name=Ritik&spouse_dob=09-09-1994&marrige_anniversery_date=09-09-2007&children=Two&wpn=12121456454445&wpn_issuedate=09-09-2007&wpn_expirydat=09-09-2007&passport_number=63564845649648548&passport_issuedate=09-09-2007&passsport_expirydat=09-09-2007&visa_number=7444465456465654564&visa_issuedat=09-09-2007&visa_expirydate=09-09-20074')?>" target="_blank"><?=site_url('Api/updateEmployeProfile?user_id=43&first_name=shilpa&email=kripa@infograins.com&date_of_birth=2017-12-01&marital_status=Married&last_name=agrwal&address=Indore&contact_no=2589635&emergency_contact_name=ritika&emergency_contact_number=1234567890&city_of_birth=Indore&country_of_birth=ndia&address_two=Lane%202%20India&telephone=102121544&email_two=archana@infograins.com&nsn=4654654546545656456564&spouse_name=Ritik&spouse_dob=09-09-1994&marrige_anniversery_date=09-09-2007&children=Two&wpn=12121456454445&wpn_issuedate=09-09-2007&wpn_expirydat=09-09-2007&passport_number=63564845649648548&passport_issuedate=09-09-2007&passsport_expirydat=09-09-2007&visa_number=7444465456465654564&visa_issuedat=09-09-2007&visa_expirydate=09-09-20074')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>6</td>
				<td>get user Data</td>
				<td><a href="<?=site_url('Api/getUserData?user_id=1')?>" target="_blank"><?=site_url('Api/getUserData?user_id=1')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>7</td>
				<td>Punch History</td>
				<td><a href="<?=site_url('Api/punchHistory?user_id=1')?>" target="_blank"><?=site_url('Api/punchHistory?user_id=1')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>8</td>
				<td>privacy Policy By Compny</td>
				<td><a href="<?=site_url('Api/privacyPolicyByCompny?user_id=1')?>" target="_blank"><?=site_url('Api/privacyPolicyByCompny?user_id=1')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>9</td>
				<td>Employee Contract</td>
				<td><a href="<?=site_url('Api/getContract?user_id=31')?>" target="_blank"><?=site_url('Api/getContract?user_id=31')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>10</td>
				<td>Employee Probations</td>
				<td><a href="<?=site_url('Api/getProbations?user_id=49')?>" target="_blank"><?=site_url('Api/getProbations?user_id=49')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>11</td>
				<td>Transfer List</td>
				<td><a href="<?=site_url('Api/trnsferList?user_id=49')?>" target="_blank"><?=site_url('Api/trnsferList?user_id=49')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
				<td>12</td>
				<td>Prmotion List</td>
				<td><a href="<?=site_url('Api/prmotionList?user_id=49')?>" target="_blank"><?=site_url('Api/prmotionList?user_id=49')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
				<td>13</td>
				<td>Login</td>
				<td><a href="<?=site_url('Api/login?username=tina&password=123456&device_id=123&device_type=anroid&user_role=9')?>" target="_blank"><?=site_url('Api/login?username=tina&password=123456&device_id=123&device_type=anroid&user_role=9')?></a></td>
				<td>2017-01-04</td>
			</tr>

				<tr>
				<td>14</td>
				<td>Add transfer</td>
				<td><a href="<?=site_url('Api/addTransfer?user_id=49&transfer_date=28-05-18&transfer_department=11&department_from=11&transfer_location=4&transferfrom=4&company_id=17')?>" target="_blank"><?=site_url('Api/addTransfer?user_id=49&transfer_date=28-05-18&transfer_department=11&department_from=11&transfer_location=4&transferfrom=4&company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>15</td>
				<td>Add travel</td>
				<td><a href="<?=site_url('Api/addTravel?user_id=49&destination=Delhi&purpose=Traning&description=for%20testing&dep_date=2018-01-05&return_date=2018-01-20&company_id=17')?>" target="_blank"><?=site_url('Api/addTravel?user_id=49&destination=Delhi&purpose=Traning&description=for%20testing&dep_date=2018-01-05&return_date=2018-01-20&company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>16</td>
				<td>Add tickiting</td>
				<td><a href="<?=site_url('Api/addTicket?user_id=1&subject=test&priority=2&description=test%20description&company_id=17')?>" target="_blank"><?=site_url('Api/addTicket?user_id=1&subject=test&priority=2&description=test%20description&company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>


				<tr>

				<td>17</td>
				<td>Apply Appraisal</td>
				<td><a href="<?=site_url('Api/applyAppraisal?user_id=1&name=Hemant%20Anjana&designation_id=1&last_appraisal_date=2017-01-01&expected_appraisal_date=2018-01-01&current_salary=10000&expected_salary=25000')?>" target="_blank"><?=site_url('Api/applyAppraisal?user_id=1&name=Hemant%20Anjana&designation_id=1&last_appraisal_date=2017-01-01&expected_appraisal_date=2018-01-01&current_salary=10000&expected_salary=25000')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>18</td>
				<td>Apply Prposal</td>
				<td><a href="<?=site_url('Api/apply_prmotion?user_id=49&company_id=17&title=prmotion&description=test promotion&location_To=4&location_from=5&department_to=11&department_from=11&designation_to=27&designation_from=28')?>" target="_blank"><?=site_url('Api/apply_prmotion?user_id=49&company_id=17&title=prmotion&description=test promotion&location_To=4&location_from=5&department_to=11&department_from=11&designation_to=27&designation_from=28')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>19</td>
				<td>Get Department List</td>
				<td><a href="<?=site_url('Api/getDepartment?company_id=17')?>" target="_blank"><?=site_url('Api/getDepartment?company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>

				<tr>

				<td>20</td>
				<td>Get Designation List</td>
				<td><a href="<?=site_url('Api/getDesignation?department_id=11')?>" target="_blank"><?=site_url('Api/getDesignation?department_id=11')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>21</td>
				<td>Get Location List</td>
				<td><a href="<?=site_url('Api/getLocation?company_id=17')?>" target="_blank"><?=site_url('Api/getLocation?company_id=17')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>

				<td>22</td>
				<td>All request list</td>
				<td><a href="<?=site_url('Api/allRequest?user_id=5')?>" target="_blank"><?=site_url('Api/allRequest?user_id=5')?></a></td>
				<td>2017-01-04</td>
			</tr>
			

			<tr>
			<td>23</td>
				<td>AAccept reject request</td>
				<td><a href="<?=site_url('Api/acceptRejectRequest?request_id=1&request_type=Prmotion&status=8&comment=hiii')?>" target="_blank"><?=site_url('Api/acceptRejectRequest?request_id=1&request_type=Prmotion&status=8&comment=hiii')?></a></td>
				<td>2017-01-04</td>
			</tr>

			<tr>
			<td>24</td>
				<td>All request history list</td>
				<td><a href="<?=site_url('Api/requestHistory?user_id=5')?>" target="_blank"><?=site_url('Api/requestHistory?user_id=5')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
			<td>25</td>
				<td>All request with search</td>
				<td><a href="<?=site_url('Api/allRequest?user_id=5&search=NoWork')?>" target="_blank"><?=site_url('Api/allRequest?user_id=5&search=NoWork')?></a></td>
				<td>2017-01-04</td>
			</tr>
			<tr>
			<td>26</td>
				<td>All request with pagination</td>
				<td><a href="<?=site_url('Api/allRequest?user_id=5&page=0')?>" target="_blank"><?=site_url('Api/allRequest?user_id=5&page=0')?></a></td>
				<td>2017-01-04</td>
			</tr>
<tr>
			<td>27</td>
				<td>Add Ticketing</td>
				<td><a href="<?=site_url('Api/addTicket?user_id=49&company_id=17&subject=problem&priority=2&description=this is test')?>" target="_blank"><?=site_url('Api/addTicket?user_id=49&company_id=17&subject=problem&priority=2&description=this is test')?></a></td>
				<td>2017-01-04</td>
			</tr>
	<tr>
			<td>28</td>
				<td>Add Ticketing comment</td>
				<td><a href="<?=site_url('Api/addTicketComment?user_id=49&ticket_id=27&comment=hii')?>" target="_blank"><?=site_url('Api/addTicketComment?user_id=49&ticket_id=27&comment=hii')?></a></td>
				<td>2017-01-04</td>
			</tr>	

			<tr>
			<td>28</td>
				<td>Ticketing comment list</td>
				<td><a href="<?=site_url('Api/ticketCommentList?ticket_id=27')?>" target="_blank"><?=site_url('Api/ticketCommentList?ticket_id=27')?></a></td>
				<td>2017-01-04</td>
			</tr>	
		</tbody>
	</table>

	<!-- <form enctype="multipart/form-data" method="post" target="_blank" action="<?=site_url('Api/addDeleteProjectFiles')?>">
		<input type="text" name="user_id" value="1">
		<input type="text" name="project_id" value="5">
		<input type="text" name="previous_images" value="2,5,14,16">
		<input type="text" name="email" value="hemant@infograins.com">
		<input type="text" name="phone" value="7458745874">
		<input type="text" name="experience" value="2 Year">
		<input type="text" name="message" value="Dear Sir/Mam, I am able for this position and please conduct interview">
		<input type="file" name="images[]" multiple>
		<input type="submit">
	</form> -->

</body>
</html>