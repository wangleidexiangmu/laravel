<?php

namespace App\Admin\Controllers;

use App\model\weixin\weixin;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new weixin);
        $grid->w_id('W id');
        $grid->openid('Openid');
        $grid->nickname('昵称');
        $grid->sex('性别')->display(function($sex){
            if($sex==1){
                return "男";
            }else{
                return "女";
            }
        });
        $grid->headimgurl('头像')->display(function($img){
            return '<img src="'.$img.'">';
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(weixin::findOrFail($id));

        $show->w_id('W id');
        $show->openid('Openid');
        $show->nickname('Nickname');
        $show->sex('Sex');
        $show->headimgurl('Headimgurl');
        $show->sub_status('Sub status');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new weixin);

        $form->number('w_id', 'W id');
        $form->text('openid', 'Openid');
        $form->text('nickname', 'Nickname');
        $form->number('sex', 'Sex');
        $form->text('headimgurl', 'Headimgurl');
        $form->switch('sub_status', 'Sub status')->default(1);

        return $form;
    }
}
