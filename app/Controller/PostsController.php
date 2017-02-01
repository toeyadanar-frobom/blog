<?php
class PostsController extends AppController {
    
public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
        $this->Auth->allow('login','add','logout');
    }
    public function view($id = null) {
        $user_id=$this->Auth->user('id');
        $username = $this->Auth->user('username');
        $post_uid=$this->Post->findById($id);
        if(!($user_id)) {
        return $this->redirect(array('controller' =>'Users','action' => 'login'));
    }
    if (!empty($this->request->data['Comment'])) {
            $this->request->data['Comment']['foreign_id'] = $id;
            $this->request->data['Comment']['class'] = 'Post'; 
            $this->request->data['Comment']['user_id'] =$user_id; 
            $this->request->data['Comment']['name'] =$username; 
            $this->Post->Comment->create(); 
            if ($this->Post->Comment->save($this->request->data)) {
               $this->Flash->success(__('The Comment has been saved.', true),'success');
                $this->redirect(array('action'=>'view',$id));
            }
            $this->Flash->error(__('The Comment could not be saved. Please, try again.', true),'warning');
        }
        $post = $this->Post->read(null, $id); 
        $this->set(compact('post'));
        $post = $this->Post->findById($id);
        if (!$post) {
        throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            $filePath="./img/images/".$this->request->data['Post']['image']['name'];
            $filename=$this->request->data['Post']['image']['tmp_name'];
            if(move_uploaded_file($filename, $filePath)){
                echo "File Uploaded Successfully";
                $this->request->data['Post']['imagePath']=$this->request->data['Post']['image']['name'];
                if ($this->Post->save($this->request->data)) {
                      $this->Flash->success(__('Your post has been saved.'));
                }
                return $this->redirect(array('controller' =>'Posts','action' => 'index'));
               }
       }
    }
   public function manage(){
   $this->set('posts',$this->Post->find('all',array('conditions'=>array('Post.user_id'=>$this->Auth->user('id')))));
   }
   public function edit($id = null) {
        $user_id=$this->Auth->user('id');
        $post_uid=$this->Post->findById($id);
        if (!($user_id==$post_uid['Post']['user_id'])) {
        return $this->redirect(array('action' => 'index'));
        }
        $post = $this->Post->findById($id);
        if (!$post) {
        //throw new NotFoundException(__('Invalid post'));
        return $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put'))) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
        $this->Flash->success(__('Your post has been updated.'));
        return $this->redirect(array('action' => 'manage'));
        }
        $this->Flash->error(__('Unable to update your post.'));
        }
        if (!$this->request->data) {
        $this->request->data = $post;
        }
    }

    public function delete($id=null)
    {
        $user_id=$this->Auth->user('id');
        $post_uid=$this->Post->findById($id);
        if($user_id==$post_uid['Post']['user_id'])
           {
               $result=$this->Post->delete($id);
               if($result)
               {  
                $this->Flash->success(__('Your post has been deleted.'));
                return $this->redirect(array('action'=>'manage'));
               }
               else
               {
                 $this->Flash->error(__('Your delete operation has failed.'));
                 return $this->redirect(array('action'=>'manage'));
               }
            }
            else{
                return $this->redirect(array('action'=>'index'));
                }
            }
    public function isAuthorized($user) {
    if ($this->action === 'add') {
        return true;
    }
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = (int) $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true;
        }
    }
    return parent::isAuthorized($user);
}
}
?>