<?php

class Post_Controller extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->filter('before','auth');
    }

    public function action_index($course, $subject, $topic)
    {
        $linkTopic = Topic::find($topic);
        $posts = Post::where('topic_id','=',$linkTopic->id)->where('is_draft','=',0)->get();
        $data = array(
            'course' => $course,
            'subject' => $subject,
            'topic' => $topic,
            'posts' => $posts);
        return View::make('main.posts', $data);
    }

    public function action_drafts($course, $subject, $topic)
    {
        $linkTopic = Topic::find($topic);
        $posts = Post::where('topic_id','=',$linkTopic->id)->where('is_draft','=',1)->get();
        $data = array(
            'course' => $course,
            'subject' => $subject,
            'topic' => $topic,
            'posts' => $posts);
        return View::make('main.drafts', $data);
    }

    public function action_new($course, $subject, $topic_id)
    {
        $user = Auth::user();
        $topic = Topic::find($topic_id);
        $data = array(
            'isNew' => true,
            'user' => $user,
            'topic' => $topic);
        return View::make('forms.post',$data);
    }

    public function action_add($course, $subject, $topic)
    {
        $new_post = array(
            'title' => Input::get('title'),
            'body' => Input::get('body'),
            'topic_id' => Input::get('topic_id'),
            'author_id' => Input::get('author_id'),
            'is_draft' => 1,
            'links' => Input::get('links'));
        $rules = array(
            'body' => 'required');
        $v = Validator::make($new_post, $rules);
        if($v->fails()){
            return Redirect::to(URL::current())
                ->with_errors($v)
                ->with_input();
        }
        $post = new Post($new_post);
        $post->save();
        return Redirect::to(URL::to_route('listdrafts', array($course, $subject, $topic)));
    }

    public function action_edit($course, $subject, $topic, $post_id)
    {
        $edit_Post = Post::find($post_id);
        $this_topic = $edit_Post->topic()->first();
        $user = Auth::user();
        // Check if the user is the author, if not redirect.
        if($edit_Post->author_id !== $user->id){
            return Redirect::to('/');
        }
        $data = array(
            'isNew' => false,
            'user' => $user,
            'topic' => $this_topic,
            'post' => $edit_Post);
        return View::make('forms.post', $data);
    }

    public function action_update($course, $subject, $topic_id, $post_id)
    {
        $updated_post = Post::find($post_id);
        $updated_post->topic_id = Input::get('topic_id');
        $updated_post->author_id = Input::get('author_id');
        $updated_post->title = Input::get('title');
        $updated_post->body = Input::get('body');
        $updated_post->links = Input::get('links');
        $updated_post->save();
        return Redirect::to(URL::to_route('listposts',array($course, $subject, $topic_id)));
    }

    public function action_delete($course, $subject, $topic_id, $post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return Redirect::to(URL::to_route('listdrafts',array($course, $subject, $topic_id)));
    }

    public function action_approve($course, $subject, $topic_id, $post_id)
    {
        $post = Post::find($post_id);
        $post->is_draft = 0;
        $post->save();
    }
}
