<?php
namespace bundle\htmlFormBundle;

/*
    $formFieldsList = [
        ['name'=>'firstName', 'title'=>'First name', 'placeholder'=>'First name']
    ];
*/

class Form {

    private $formClass = '';

    private $formFieldsList = [];

    public function __construct($formClass = '', $formFieldsList = null)
    {
        $this->formClass = $formClass;
        $this->formFieldsList = $formFieldsList;
    }

    public function printForm()
    {
        $formClass = $this->formClass;
        $formFieldsList = $this->formFieldsList;

        if(count($formFieldsList)>0) {
            echo "<form class='$formClass'>";
                echo "<ul style='list-style: none;'>";
                    foreach ($formFieldsList as $fieldKey => $fieldInfoList) {
                        echo "<li style='margin-top: 3px'>";
                            $name = $fieldInfoList['name'];
                            $placeholder = '';
                            if(!empty($fieldInfoList['title'])){
                                $fieldTitle = $fieldInfoList['title'];
                                echo "<span class='field-title'>$fieldTitle</span></br>";
                            } if(!empty($fieldInfoList['placeholder'])) {
                                $placeholder = $fieldInfoList['placeholder'];
                            }
                            echo "<input name='$name' class='' placeholder='$placeholder' value='' />";
                        echo "</li>";
                    }
                echo "</ul>";
            echo "</form>";
        }
    }
}