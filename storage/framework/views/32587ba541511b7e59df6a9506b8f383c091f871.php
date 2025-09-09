<?php if($doc->chapterOne!==null): ?>
    <div class="list-group-item media">
        <div class="checkbox pull-left">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
            </label>
        </div>
        <?php if($doc->chapterOne->comment==null): ?>
            <div class="pull-right">
                <div class="actions dropdown">
                    <a href="" data-toggle="dropdown" aria-expanded="true">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="#" onclick="return assessChapterOne('<?php echo e($doc->chapterOne->id); ?>')">Assess</a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="media-body">
            <div class="lgi-heading f-20 f-500">
                <?php echo e($doc->chapterOne->file); ?>

                <span>
                    <a href="<?php echo e(URL::to('documentations/'.$doc->student->user->email.'/'.$doc->chapterOne->file)); ?>"
                                           target="_blank">
                        <button class="btn btn-success btn-xs"><i class="zmdi zmdi-eye">View</i></button>
                    </a>

                </span>
            </div>
            <?php if($doc->chapterOne->comment!==null): ?>
                <div class="list-group-item media" style="background-color: inherit!important;">
                    <div style="padding-left: 15px;">
                    </div>
                    <div class="pull-left">
                        <?php if(Auth::user()->image==!null): ?>
                            <img class="lgi-img" src="<?php echo e(url('profile/'.Auth::user()->image)); ?>" alt="">
                        <?php else: ?>
                            <img class="lgi-img" src="<?php echo e(URL::to('default-profile.jpg')); ?>" alt="">
                        <?php endif; ?>
                    </div>

                    <div class="pull-right">
                        <div class="actions dropdown">
                            <a href="" data-toggle="dropdown" aria-expanded="true">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="#" onclick="return editChapterOneAssessment('<?php echo e($doc->chapterOne->id); ?>')">Edit</a>
                                </li>
                                <li>
                                    <a href="#" onclick="return chapterOneDelete('<?php echo e($doc->chapterOne->id); ?>')">Delete</a>

                                </li>
                            </ul>
                        </div>
                        <form method="POST" action="<?php echo e(route('supervisor.docs.chapterone.delete',$doc->chapterOne->id)); ?>"
                              id="<?php echo e($doc->chapterOne->id); ?>" style="display: none">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" value="<?php echo e($doc->id); ?>" name="id">
                        </form>
                    </div>

                    <div class="media-body">
                        <div class="lgi-heading"><?php echo e(Auth::user()->name); ?></div>
                        <small class="lg-hide-items"><?php echo e($doc->chapterOne->comment); ?></small>
                    </div>
                </div>
            <?php endif; ?>
            <ul class="lgi-attrs f-500">
                <li class="f-500">Date Uploaded: <?php echo e($doc-> chapterOne->created_at->toDayDateTimeString()); ?></li>
                <?php if($doc->chapterOne->status==1): ?>
                    <li class="lgi-approved f-500">Approved: Yes</li>
                <?php elseif($doc->chapterOne->status==0): ?>
                    <li class="lgi-approved">Approved: Pending</li>
                <?php endif; ?>
                <?php if($doc->chapterOne->completion==3): ?>
                    <li class="lgi-completion">Completion: Not Completed</li>
                <?php elseif($doc->chapterOne->completion==2): ?>
                    <li class="lgi-completion">Completion: Not to Standards</li>
                <?php elseif($doc->chapterOne->completion==1): ?>
                    <li class="lgi-completion">Completion:Fully Completed</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>