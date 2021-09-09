  <style type="text/css">
            { margin:0; padding: 0;}
     /*       body{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tcmybg {
                background: top center;
                background-size: contain;
                position: absolute;
                left: 0;
                bottom: 10px;
                width: 200px;
                height: 200px;
                margin-left: auto;
                margin-right: auto;
                right: 0;
            }
            /*begin students id card*/
            .studenttop img{width:30px;vertical-align: top;}
            .studenttop{background: <?php echo $idcard->header_color; ?>;padding:2px;color: #fff;overflow: hidden;
                        position: relative;z-index: 1;}
            .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
            .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
            .staddress{margin-bottom: 0; padding-top: 2px;}
            .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
            .stlist{padding: 0; margin:0; list-style: none;}
            .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
            .stlist li span{width:65%;float: right;}
            .stimg{
                /*margin-top: 5px;*/
                width: 80px;
                height: auto;
                /*margin: 0 auto;*/
            }
            .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
            .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
            .staround2{position: relative; z-index: 9;}
            .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
            /*.stidcard{margin-top: 0px;
                color: #fff;font-size: 16px; line-height: 16px;
                padding: 2px 0 0; position: relative; z-index: 1;
                background: #453277;
                text-transform: uppercase;}*/
            .principal{margin-top: -40px;margin-right:10px; float:right;}
            .stred{color: #000;}
            .spanlr{padding-left: 5px; padding-right: 5px;}
            .cardleft{width: 20%;float: left;}
            .cardright{width: 77%;float: right; }
        </style>
        <?php $dummy_date = "2020-01-01"; ?>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr> 
                <td valign="top" width="32%" style="padding: 3px;">
                    <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="background: #efefef;">
                        <tr>
                            <td valign="top">
                                <img src="<?php echo base_url('uploads/staff_id_card/background/') ?><?php echo $idcard->background; ?>" class="tcmybg" style="opacity: .1"/></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="studenttop">
                                    <div class="sttext1"><img src="<?php echo base_url('uploads/staff_id_card/logo/') ?><?php echo $idcard->logo; ?>" width="30" height="30" />
                                        <?php echo $idcard->school_name; ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center" style="padding: 1px 0;">
                                <p><?php echo $idcard->school_address; ?></p>
                            <!-- <p>Phone:0761 424242 <span class="spanlr">|</span> E-mail:mountcarmel@gmail.com</p> -->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: <?php echo $idcard->header_color; ?>;text-transform: uppercase;"><?php echo $idcard->title; ?></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="staround">
                                    <div class="cardleft">
                                        <div class="stimg">
                                            <img src="<?php echo base_url('uploads/student_images/no_image.png') ?>" class="img-responsive" />
                                        </div>
                                    </div><!--./cardleft-->
                                    <div class="cardright">
                                        <ul class="stlist">
                                            <?php
                                            if ($idcard->enable_name == 1) {
                                                echo "<li>"; echo $this->lang->line('staff').' '; echo $this->lang->line('name'); echo "<span>Mohan Patil</span></li>";
                                            } 
                                            ?>
                                            <?php
                                            if ($idcard->enable_staff_id == 1) {
                                                echo "<li>"; echo $this->lang->line('staff_id');echo "<span>9000</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_designation == 1) {
                                                echo "<li>"; echo $this->lang->line('designation');echo "<span>Administator</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_staff_department == 1) {
                                                 echo "<li>"; echo $this->lang->line('department');echo "<span>Admin</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_fathers_name == 1) {
                                                echo "<li>"; echo $this->lang->line('father_name'); echo "<span>Sohan Patil</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_mothers_name == 1) {
                                                echo "<li>"; echo $this->lang->line('mother_name'); echo "<span>Kirti Patil</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_date_of_joining == 1) {
                                                echo "<li>"; echo $this->lang->line('date_of_joining'); echo "<span>"; echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($dummy_date)); echo "</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_permanent_address == 1) {
                                                echo "<li>"; echo $this->lang->line('address'); echo "<span>Near Railway Station Jabalpur</span></li>";
                                            }
                                            ?>
                                             <?php
                                            if ($idcard->enable_staff_phone == 1) {
                                                echo "<li>"; echo $this->lang->line('phone'); echo "<span>9845624781</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_staff_dob == 1) {
                                                echo "<li>"; echo $this->lang->line('date_of_birth'); echo "<span>"; echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($dummy_date)); echo "</span></li>";
                                            }
                                            ?>
                                        </ul>
                                    </div><!--./cardright-->
                                </div><!--./staround-->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="principal"><img src="<?php echo base_url('uploads/staff_id_card/signature/') ?><?php echo $idcard->sign_image; ?>" width="66" height="40" /></td>
                        </tr>
                    </table>
                </td>
            </tr>  
        </table>