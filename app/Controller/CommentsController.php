<?php
class CommentsController extends AppController {
	    public function delete($id=null)
      {  
        $user_id=$this->Auth->user('id');
        $comment_fields=$this->Comment->findById($id);
        $comment_id=$comment_fields['Comment']['id'];
        if($user_id == $comment_fields['Comment']['user_id']){
              $result=$this->Comment->delete($comment_id);
              if($result){  
                $this->Flash->success(__('Your comment has been deleted.'));
                return  $this->redirect(array('action'=>'index','controller'=>'posts'));
              }
              else{
                 $this->Flash->error(__('Your delete operation has failed.'));
                 return $this->redirect(array('action'=>'index','controller'=>'posts'));
              }
            }
            else{
                return $this->redirect(array('action'=>'index','controller'=>'posts'));
            }
      }
}    
?>