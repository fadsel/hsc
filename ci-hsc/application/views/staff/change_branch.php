<?php
$online = check_if_online();
?>

<div class="row">

        <div class="row push-down-15">
            <div class="col-lg-12">
                <div class="pull-right push-from-right-15">
                    <?php if(!$this->session->userdata('show_all_users')){?>
                        <a data-toggle="tooltip" data-placement="top" title="Show All users" rel="info" href="<?php echo base_url('staff/show_all_users/');?>"><p class="btn btn-primary <?php echo ($this->session->userdata('show_all_users'))?"active":'';?>"><i class="fa fa-users"></i></p></a>
                    <?php } else {?>
                        <a data-toggle="tooltip" data-placement="top" title="Show branch users only" rel="info" href="<?php echo base_url('staff/show_branch_users/');?>"><p class="btn btn-primary <?php echo (!$this->session->userdata('show_all_users'))?"active":'';?>"><i class="fa fa-male"></i></p></a>
                    <?php } ?>


                </div>
                <?php if($this->session->userdata('auth_type')==21){?>
                    <div class="pull-left push-from-left-15">
                        <a data-toggle="tooltip" data-placement="right" title="Variances from all branches" rel="info" href="<?php echo base_url('reports/reset_all_variances');?>"><p class="btn btn-success"><i class="fa fa-retweet"></i> Reset All</p></a>
                    </div>
                <?php }?>
            </div>
        </div>

    <?php
    //col-md-offset-2 col-md-8 col-lg-offset-3
    foreach($staffs as $key=>$staff){?>
        <!--                        mpya-->
        <div class="col-lg-12">

            <div class="well well-list">
                <div class="col-lg-1 visible-lg visible-md">
                    <img src="<?php
                    switch($this->staffs->get_profile($staff['id'])[0]['gender']){
                        case 'male':
                            //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=mm&";//d=".base_url('assets/img/default-user-icon-profile.png');
                            if($this->staffs->get_profile($staff['id'])[0]['img_url'] AND $online == true){
                                echo $this->staffs->get_profile($staff['id'])[0]['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile.png');
                            }
                            break;
                        case 'female':

                            if($this->staffs->get_profile($staff['id'])[0]['img_url']  AND $online==true){
                                echo $this->staffs->get_profile($staff['id'])[0]['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile-pink.png');
                            }

                            // echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=retro";//;&d=".base_url('assets/img/default-user-icon-profile-pink.png');
                            break;

                        default : echo base_url('assets/img/default-user-icon-profile.png'); break;
                    }?>
                                " alt="" class="img-circle img-responsive">


                </div>
                <div class="col-lg-5 well-list-description">
                    <h2><?php echo $this->staffs->get_profile($staff['id'])[0]['first_name']." "
                            .$this->staffs->get_profile($staff['id'])[0]['last_name'];?></h2>
                    <p>
                        <?php
                        echo make_me_bold($this->staffs->get_auth_type_name($staff['auth_type']));
                        if($staff['branch_id']!=0){
                            echo " currently assigned at ".make_me_bold($this->usuals->get_branch_name($staff['branch_id']));
                        }


                        ?></p>
                    <p class="small text-muted">
                        <?php echo $staff['email'];?>
                    </p>
                </div>
                <?php if($this->session->userdata('auth_type')==23 or $this->session->userdata('auth_type')==30 or $this->session->userdata('auth_type')<=20){?>
                <div class="col-lg-5">
                    <div class="text-right">
                        <div class="responsive-select form-group col-lg-12 col-lg-8 col-xs-8 col-sm-8 text-right pull-right">
                            <form action="<?php echo base_url('staff/change_staff_details');?>" method="post">
                                <div class="input-group">
                                    <select class='form-control input-append' name='branch_id'>
                                        <?php

                                        foreach($this->usuals->get_all_branches() as $branch){?>
                                            <option value="<?php echo $branch['id'];?>" <?php
                                                if($branch['id']==$staff['branch_id']){echo "selected";}
                                                ?>> <?php echo $branch['name'];echo ($branch['id']<=7)?" Branch":"";?></option>

                                        <?php } ?>

                                    </select>
              <span class="input-group-btn">
                  <input value="<?php echo $staff['id'];?>" type="hidden" class="btn btn-cool input-append" name="user_id"/>

                  <input value="<?php echo $this->usuals->get_branch_name($staff['branch_id']);?>" type="hidden" class="btn btn-cool input-append" name="from_branch"/>
                  <input value="<?php echo $staff['branch_id'];?>" type="hidden" class="btn btn-cool input-append" name="from_branch_id"/>

                  <input value="<?php echo $this->staffs->get_profile($staff['id'])[0]['first_name']." "
                      .$this->staffs->get_profile($staff['id'])[0]['last_name'];?>" type="hidden" class="btn btn-cool input-append" name="full_name"/>
                  <input value="update" type="submit" class="btn btn-cool input-append"/>

              </span>
                                </div>


                                </form>


                        </div>
                    </div>


                </div>
                <?php }?>
            </div>

        </div>
    <?php } ?>
</div>