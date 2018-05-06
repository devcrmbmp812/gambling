<div class="containerChat">
    <div class="col-md-3 askChatBox chatWindow">
      <!-- DIRECT CHAT PRIMARY -->
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border displayControlButton" style="cursor:pointer;">
                <h4 class="box-title displayControlButton">고객센터 문의하기</h4>
        
                <div class="box-tools pull-right">
                    <!--
                    <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    
                    <button type="button" class="btn btn-box-tool newMessage" data-toggle="tooltip" title="New Message" data-widget="chat-pane-toggle">
                    <i class="fa fa-comments new-messages newMessageCount">3</i></button>-->
                    <button type="button" class="btn btn-box-tool hideShow displayControlButton" data-widget="collapse"><i class="fa fa-minus minimize"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="askChat chatBody">
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages ___chatBoxBody___ ___chatBoxBody_<?php echo User::loggedInUserId();?>_1" data-scroll="1">
                    <!-- Message. Default to the left -->
                    <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right" style="padding-right:5px;">운영자</span>
                               <!--  <span class="direct-chat-timestamp pull-left">12 Jun 2:05 pm</span> -->
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="images/avatar1.png" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                             해당 창은 라이브 채팅이 아닙니다.
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right" style="padding-right:5px;">운영자</span>
                                <!-- <span class="direct-chat-timestamp pull-left">12 Jun 2:05 pm</span> -->
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="images/avatar1.png" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                             사이트 관련하여 질문사항이 있으실 경우, 메세지를 남겨주시면 확인하는대로 답변을 드리도록 하겠습니다. 감사합니다
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                    </div><!--/.direct-chat-messages-->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <form action="" method="POST" class="myChatForm" enctype="multipart/form-data" id="myChatForm_1" name="myChatForm_1">
                    <div class="input-group">
                        <?php $logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0; ?>
                        <input type="hidden" name="chatId" value="<?php echo $logedInID; ?>" />
                        <input type="hidden" name="receiverId" value="1" />
                        <input type="text" name="chatText" id="chatText" placeholder="메세지를 입력해주세요 ..." class="form-control chatText"<?php if(!User::loggedInUserId() > 0){ echo " disabled"; }?>>
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-flat chatSend"<?php if(!User::loggedInUserId() > 0){ echo " disabled"; }?>>전송</button>
                          </span>
                    </div>
                  </form>
                </div><!-- /.box-footer-->
            </div>
        </div><!--/.direct-chat -->
    </div>
</div>
