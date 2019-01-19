<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends Controller
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
        return $content->header(111)
            ->withInfo('sss')
            ->description('lalala')
            ->body(
                $this->grid()
            );
    }

    public function grid()
    {
        $grid = new Grid(new Product());
        $grid->id('ID')->sortable();
        $grid->column('name', '产品名称')->editable();
        $grid->column('android_url', '安卓');
        $grid->column('ios_url', 'ios');
        $states = [
            'on' => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->status('是否上线')->switch($states);
        // filter($callback)方法用来设置表格的简单搜索框
        $grid->filter(function ($filter) {
            // 设置created_at字段的范围查询
            $filter->between('created_at', 'Created Time')->datetime();
        });
        $grid->disableExport();
        return $grid;
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show =  (new Admin())->show((new Product())->find($id));

        $show->id('ID');
        $show->text('ios_url', 'ios下载链接')->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $show->number('sort', '排序')->default(0)->rules('gte:0');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
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
            ->header('产品管理')
            ->description('新增')
            ->body($this->form());
    }

    public function form()
    {
        $grid = (new Admin())->form(Product::class, function (Form $form) {
            $form->switch('status', '是否开启')->rules('required');
            $form->text('url', '访问链接')->rules('required');
            $form->text('android_url', '安卓下载链接')->rules('required');
            $form->text('ios_url', 'ios下载链接')->rules('required');
            $form->switch('status', '是否上线');
            $form->number('sort', '排序')->default(0)->rules('gte:0');
            $form->text('name', '习惯吗')->default(0)->rules('gte:0');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            return $form;
        });
        return $grid;
    }
}
