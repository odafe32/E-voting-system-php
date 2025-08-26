<!-- Add New NSUK Student Modal -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="   background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 10px 10px 0 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> <b>Add New NSUK Student</b></h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form class="form-horizontal" method="POST" action="voters_add.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label" style="font-weight: 600;">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstname" name="firstname" 
                                   placeholder="Enter student's first name" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label" style="font-weight: 600;">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastname" name="lastname" 
                                   placeholder="Enter student's last name" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="matric_number" class="col-sm-3 control-label" style="font-weight: 600;">Matric Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="add_matric" name="matric_number" 
                                   placeholder="0220XXXXX" pattern="^0220.*" 
                                   title="Matric number must start with 0220" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px; font-family: 'Courier New', monospace;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-info-circle"></i> Format: 0220XXXXX (NSUK Standard Format)
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label" style="font-weight: 600;">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Create a secure password" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-lock"></i> Minimum 6 characters recommended
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label" style="font-weight: 600;">Student Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" accept="image/*"
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px; width: 100%;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-camera"></i> Supported: JPG, JPEG, PNG, GIF (Max: 2MB)
                            </small>
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 30px;">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal" 
                        style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-close"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary btn-flat" name="add" 
                        style="   background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-save"></i> Add Student
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit NSUK Student Modal -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 10px 10px 0 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <b>Edit Student Information</b></h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form class="form-horizontal" method="POST" action="voters_edit.php">
                    <input type="hidden" class="id" name="id">
                    <div class="form-group">
                        <label for="edit_firstname" class="col-sm-3 control-label" style="font-weight: 600;">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_firstname" name="firstname" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_lastname" class="col-sm-3 control-label" style="font-weight: 600;">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_lastname" name="lastname" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_matric" class="col-sm-3 control-label" style="font-weight: 600;">Matric Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_matric" name="matric_number" 
                                   pattern="^0220.*" title="Matric number must start with 0220" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px; font-family: 'Courier New', monospace;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-info-circle"></i> Format: 0220XXXXX (NSUK Standard Format)
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_password" class="col-sm-3 control-label" style="font-weight: 600;">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="edit_password" name="password" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-key"></i> Leave unchanged to keep current password
                            </small>
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 30px;">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"
                        style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-close"></i> Cancel
                </button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"
                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-check-square-o"></i> Update Student
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Student Modal -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%); color: white; border-radius: 10px 10px 0 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> <b>Delete Student Record</b></h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form class="form-horizontal" method="POST" action="voters_delete.php">
                    <input type="hidden" class="id" name="id">
                    <div class="text-center">
                        <div style="font-size: 60px; color: #dc3545; margin-bottom: 20px;">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <h4 style="color: #2c3e50; margin-bottom: 15px;">Are you sure you want to delete this student?</h4>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 20px 0;">
                            <h3 style="color: #dc3545; margin-bottom: 10px;"><strong class="fullname"></strong></h3>
                            <p style="margin: 5px 0;">
                                <strong>Matric Number:</strong> 
                                <span class="matric_display" style="font-family: 'Courier New', monospace; background: #e9ecef; padding: 5px 10px; border-radius: 5px;"></span>
                            </p>
                        </div>
                        <div class="alert alert-danger" style="border-radius: 8px; border: none;">
                            <i class="fa fa-warning"></i> <strong>Warning:</strong> This action cannot be undone! All voting records associated with this student will also be affected.
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 30px;">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"
                        style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-close"></i> Cancel
                </button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"
                        style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%); border: none; border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-trash"></i> Delete Student
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Student Photo Modal -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%); color: white; border-radius: 10px 10px 0 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-camera"></i> <b>Update Student Photo</b></h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form class="form-horizontal" method="POST" action="voters_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="id" name="id">
                    <div class="text-center" style="margin-bottom: 25px;">
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                            <h4 style="color: #2c3e50; margin-bottom: 10px;"><strong class="fullname"></strong></h4>
                            <p style="margin: 5px 0;">
                                <strong>Matric Number:</strong> 
                                <span class="matric_display" style="font-family: 'Courier New', monospace; background: #e9ecef; padding: 5px 10px; border-radius: 5px;"></span>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label" style="font-weight: 600;">New Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" accept="image/*" required
                                   style="border-radius: 8px; border: 2px solid #e9ecef; padding: 10px; width: 100%;">
                            <small class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-info-circle"></i> Supported formats: JPG, JPEG, PNG, GIF (Maximum size: 2MB)
                            </small>
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 30px;">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"
                        style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-close"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary btn-flat" name="upload"
                        style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%); border: none; border-radius: 8px; padding: 10px 20px;">
                    <i class="fa fa-upload"></i> Update Photo
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Modal Styling */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    overflow: hidden;
}

.modal-header {
    border-bottom: none;
    padding: 20px 30px;
}

.modal-body {
    background: #ffffff;
}

.modal-footer {
    background: #f8f9fa;
    border-radius: 0 0 15px 15px;
}

.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    transform: translateY(-1px);
    transition: all 0.3s ease;
}

.btn-flat {
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-flat:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Matric number validation styling */
#add_matric:invalid, #edit_matric:invalid {
    border-color: #dc3545 !important;
}

#add_matric:valid, #edit_matric:valid {
    border-color: #28a745 !important;
}

/* Enhanced form labels */
.control-label {
    color: #2c3e50;
    font-size: 14px;
}

/* Alert styling */
.alert {
    border-radius: 10px;
    border: none;
}

/* Small text styling */
.text-muted {
    color: #6c757d !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body, .modal-footer {
        padding: 20px;
    }
    
    .col-sm-3, .col-sm-9 {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Real-time matric number validation
    $('#add_matric, #edit_matric').on('input', function(){
        var matric = $(this).val();
        var isValid = matric.startsWith('0220') && matric.length >= 15;
        
        if(matric.length > 0) {
            if(!isValid) {
                $(this).css({
                    'border-color': '#dc3545',
                    'box-shadow': '0 0 0 0.2rem rgba(220, 53, 69, 0.25)'
                });
                $(this).siblings('.help-block').remove();
                $(this).after('<div class="help-block" style="color: #dc3545; font-size: 12px; margin-top: 5px;"><i class="fa fa-exclamation-circle"></i> <Matric number must start with 0220/div>');
            } else {
                $(this).css({
                    'border-color': '#28a745',
                    'box-shadow': '0 0 0 0.2rem rgba(40, 167, 69, 0.25)'
                });
                $(this).siblings('.help-block').remove();
                $(this).after('<div class="help-block" style="color: #28a745; font-size: 12px; margin-top: 5px;"><i class="fa fa-check-circle"></i> Valid NSUK matric number format</div>');
            }
        } else {
            $(this).css({
                'border-color': '#e9ecef',
                'box-shadow': 'none'
            });
            $(this).siblings('.help-block').remove();
        }
    });

    // Form validation before submission
    $('form').on('submit', function(e) {
        var matricInput = $(this).find('#add_matric, #edit_matric');
        if(matricInput.length > 0) {
            var matric = matricInput.val();
            if(!matric.startsWith('0220') || matric.length < 15) {
                e.preventDefault();
                alert('Please enter a valid NSUK matric number starting with 0220');
                matricInput.focus();
                return false;
            }
        }
    });
});
</script>