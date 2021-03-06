<?php
class Admin_LeavesController extends TinyPHP_Controller {
	
	public function indexAction()  
	{
	
	}

	public function addAction()
    {
        if($this->isPost())
        {
            $status = 0;
            $errors = [];

			$this->setNoRenderer(true);

        $leaves = new Models_Leave();
	
        $leaves->type = $this->getRequest()->getPostVar('type');
        $startDate = $this->getRequest()->getPostVar('startDate');
        $endDate = $this->getRequest()->getPostVar('endDate');
        $stdt = new DateTime($startDate);
        $endt = new DateTime($endDate);
        $leaves->startDate =  $stdt->getTimestamp();
        $leaves->endDate = $endt->getTimestamp();
        $leaves->isHalf = $this->getRequest()->getPostVar('isHalf');
        $leaves->comment = $this->getRequest()->getPostVar('comment');
        $isCreated = $leaves->create();

        if( $isCreated == true )
        {
            $status = 1;
        }
        else
        {
            $errors = $leaves->getErrors();
        }
            
            $response = ["status" => $status, "errors" => $errors];
            echo json_encode($response);
            die; 

    	}
    }

    public function updateAction()
    {
        if($this->isPost())
        {   
            // POST Request

            $this->setNoRenderer(true);

            $status = 0;
            $errors = [];

            $leaveId =  $this->getRequest()->getPostVar('id');
            $leave = new Models_Leave($leaveId);
            
            $leave->status = $this->getRequest()->getPostVar('status');
        
                $isUpdated = $leave->update();
                if($isUpdated)
                {

                    $status = 1;
                }
                else
                {
                    $errors = $leave->getErrors();
                }
            
            $response = ["status" => $status, "errors" => $errors];
            echo json_encode($response);
            die;
        }
        else
        {
            // GET Request
            $id = $this->getRequest()->getVar('id');

            $leave = new Models_Leave();      
            $leaveData = $leave->fetchRow($id);
            $this->setViewVar('dataRow',$leaveData);
        }
           
    }

    public function leavelistAction()
    {
        $this->setNoRenderer(true);

        global $db;
        $dt = new TinyPHP_DataTable();
	    $dt->setDBAdapter($db);
        $dt->setTable('leaves AS l');
        $dt->setIdColumn('l.id');

        $dt->setJoins("INNER JOIN users AS b ON b.id = l.userId");

        $dt->addColumns(array(
            'id' => 'l.id',
            'userName' => 'b.firstName',
            'type' => 'l.type',
            'startDate' => 'DATE_FORMAT(FROM_UNIXTIME(l.startDate), "%m-%d-%Y")',
            'endDate' => 'DATE_FORMAT(FROM_UNIXTIME(l.endDate), "%m-%d-%Y")',
            'comment' => 'l.comment',
            'status' => 'l.status'
        ));
        $dt->getData();
    }

}