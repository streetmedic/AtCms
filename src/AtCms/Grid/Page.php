<?php

namespace AtCms\Grid;

use AtAdmin\DataGrid;
use AtAdmin\DataGrid\Filter;
use AtAdmin\DataGrid\Column\Decorator;
use Zend\Form\Element;

class Page extends DataGrid\DataGrid
{
    public function init()
    {
        parent::init();

        $this->setCaption('Manage pages')
             ->setIdentifierColumn('page_id');

        // id
        $this->getColumn('page_id')
             ->setLabel('#')
             ->setVisibleInForm(false)
             ->setSortable(true);

        // uri
        $this->getColumn('identifier')
             ->setLabel('Page identifier (uri)')
             ->addFilter(new Filter\Like())
             ->setSortable(true);

        // title
        $this->getColumn('title')
             ->setLabel('Title')
             ->addFilter(new Filter\Like());

        // content
        //$content = new ATF_DataGrid_Column_Wysiwyg('content');
        $this->getColumn('content')
             ->setLabel('Page Content')
             ->setVisible(false);
        //$this->addColumn($content, true);

        // description
        $this->getColumn('meta_description')
             ->setLabel('Meta Description')
             ->setVisible(false);

        // keywords
        $this->getColumn('meta_keywords')
             ->setLabel('Meta Keywords')
             ->setVisible(false);

        // created_at
        $this->getColumn('created_at')
             ->setLabel('Date Created')
             ->setVisibleInForm(false);

        // updated_at
        $this->getColumn('updated_at')
             ->setLabel('Last Modified')
             ->setVisibleInForm(false);

        // is_active
        $isActiveFilterFormElement = new Element\Select('is_active');
        $isActiveFilterFormElement->setValueOptions(array('' => 'All', 0 => 'No', 1 => 'Yes'));

        $this->getColumn('is_active')
             ->setLabel('Enabled')
             ->addDecorator(new Decorator\YesNo())
             ->addFilter(new Filter\Equal)
             ->setFormElement(new Element\Checkbox('is_active'))
             ->setFilterFormElement($isActiveFilterFormElement);

        // sort_order
        $this->getColumn('sort_order')
             ->setLabel('Sort Order');
   }
}