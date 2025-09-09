<div class="modal fade" id="assessChapterThree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assess Chapter Three Documentation</h4>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <form action="<?php echo e(route('supervisor.docs.chapterthree.assessment')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="chapter_three_id">
                    <div class="form-group">
                        <label for="password" class="col-sm-12 control-label" style="text-align: left;"><b>Comment</b></label>
                        <div class="col-sm-12">
                            <div class="fg-line<?php echo e($errors->has('milestone') ? ' has-error' : ''); ?>">
                                <textarea rows="5" class="form-control" name="comment" id="sum" required></textarea>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label" style="text-align: left;"><b>Completion</b></label>
                        <div class="col-sm-9">
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="completion" value="1">
                                <i class="input-helper"></i>
                                Fully
                            </label>

                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="completion" value="2">
                                <i class="input-helper"></i>
                                Partially
                            </label>

                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="completion" value="3">
                                <i class="input-helper"></i>
                                Not Completed
                            </label>

                        </div>
                        <br><br>
                    </div>
                    <br>

                    <div class="modal-footer">
                        <button type="submit"   class="btn btn-primary btn-hover-green btn-sm pull-left" data-action="save" role="button" >Update</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>