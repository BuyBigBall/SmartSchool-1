<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-bus"></i> <?php echo $this->lang->line('question'); ?></h1>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('question') . " " . $this->lang->line('bank'); ?></h3>


                    </div>
                    <div class="box-body">
                     
                        <div class="mailbox-messages">
                              <div class="row mb10">
                
                           <div class="col-lg-3 col-md-3 col-sm-12">
                             <b> <?php echo $this->lang->line('subject'); ?></b> :<?php echo $question->name; ?>
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-12">
                            <b> <?php echo $this->lang->line('level'); ?></b> :<?php echo $question_level[$question->level]; ?>
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-12">
                             <b> <?php echo $this->lang->line('question_type'); ?> </b>  :<?php echo $question_type[$question->question_type]; ?>
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-12">
                            <?php 

$question_class=($question->section_name != "")? $question->class_name."(". $question->section_name.")" : $question->class_name;
                             ?>
                            <b><?php echo $this->lang->line('class'); ?> </b> :<?php echo $question_class; ?>
                           </div>
                           <!--lcol-lg-6-->    
                        </div>
                            <div class="questiondetail"><b><?php echo $this->lang->line('question'); ?>:</b>
                            <?php echo $question->question; ?>
                         </div>

                              <?php
if($question->question_type != "descriptive"){

   if ($question->question_type == "singlechoice") {
    
      foreach ($questionOpt as $question_opt_key => $question_opt_value) {
    $select_opt = "";
    if ($question->correct == $question_opt_key) {
        $select_opt = "active";
    }
  
   if($question->{$question_opt_key} != ""){
    ?>
  <div class="<?php echo $select_opt; ?> quesanslist">
  <?php echo $this->lang->line('option_' . $question_opt_value) . " :&nbsp; " . $question->{$question_opt_key}; ?>
  </div>
   <?php

   }
}
}elseif ($question->question_type == "multichoice") {
    $correct_ans=json_decode($question->correct);
         foreach ($questionOpt as $question_opt_key => $question_opt_value) {
    $select_opt = "";
    if (in_array($question_opt_key,$correct_ans)) {
        $select_opt = "active";
    }
   
    if($question->{$question_opt_key} != ""){
   ?>
  <div class="<?php echo $select_opt; ?> quesanslist">
  <?php echo $this->lang->line('option_' . $question_opt_value) . " :&nbsp; " . $question->{$question_opt_key}; 
  ?>
  </div>
   <?php
    }
 
}
}   elseif ($question->question_type == "true_false") {
    
      foreach ($question_true_false as $question_opt_key => $question_opt_value) {
    $select_opt = "";
    if ($question->correct == $question_opt_key) {
        $select_opt = "active";
    }
    ?>

  <div class="<?php echo $select_opt; ?> quesanslist">
  <?php echo $question_opt_key; ?>
  </div>
                                <?php
}
}
} 
?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>