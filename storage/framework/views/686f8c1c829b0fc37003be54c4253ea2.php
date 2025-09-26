<?php if (isset($component)) { $__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0 = $attributes; } ?>
<?php $component = App\View\Components\Admin::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Admin::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'View Deductions'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Loan</h3>
            <div class="card-tools"><a href="<?php echo e(route('deductions.loans.index')); ?>" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('deductions.loans.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Loan Type:*</label>
                            <select name="LoanType" id="LoanType" class="form-control" required>
                                <option value="" selected disabled>select loan type</option>
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>loantype <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="LoanType" class="form-label">Description:*</label>
                            <select name="description" id="description" class="form-control" required>
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>loantype <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="name">Employee Code:*</label>
                            <input class="form-control" id="empcode" name="empcode" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Employee" class="form-label">Employee:*</label>
                            <select name="Employee" id="Employee" class="form-control" required>
                                <option value="" selected disabled>Select Employee</option>
                            </select>
                            <?php if (isset($component)) { $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Employee <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $attributes = $__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__attributesOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46)): ?>
<?php $component = $__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46; ?>
<?php unset($__componentOriginal26e98e8e5cc4164d9d54ab94efc26e46); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Loan Number:*</label>
                            <input class="form-control" id="loannumber" name="loannumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">SSS Number:*</label>
                            <input class="form-control" id="sssnumber" name="sssnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">PhilHealth Number:*</label>
                            <input class="form-control" id="phicnumber" name="phicnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">HDMF Number:*</label>
                            <input class="form-control" id="hdmfnumber" name="hdmfnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Select Date:</label>
                            <input type="text" class="form-control datepicker" id="date" name="date"
                                placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Loan Amount:</label>
                            <input type="number" class="form-control" id="loanAmount" value="0" name="loanAmount" placeholder="Enter Loan Amount">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">No of Payments:</label>
                            <input type="number" class="form-control" id="installment" name="installment" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Amount of Deduction:</label>
                            <input type="decimal" class="form-control" id="deductionAmount" name="deductionAmount" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Semi-Monthly Interest(%):</label>
                            <input type="number" class="form-control" id="SemiInterest" name="SemiInterest" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Total Interest:</label>
                            <input type="number" class="form-control" id="TotalInterest" name="TotalInterest" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Interest Balanace:</label>
                            <input type="number" class="form-control" id="InterestBalance" name="InterestBalance" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Balance:</label>
                            <input type="number" class="form-control" id="Balance" name="Balance" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0)): ?>
<?php $attributes = $__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0; ?>
<?php unset($__attributesOriginal2812d824e80b3a65bceda8e6a9bfa7a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0)): ?>
<?php $component = $__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0; ?>
<?php unset($__componentOriginal2812d824e80b3a65bceda8e6a9bfa7a0); ?>
<?php endif; ?>
<script>
    $(document).ready(function() {
        // Cutoff Change
        $('#LoanType').change(function() {
            // Cutoff id
            var lt = $(this).val();
            $('#description').find('option').remove().end();
            // AJAX request 
            $.ajax({
                url: '/deductions/getloandesc/' + lt,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response.length > 0) {
                        response.forEach(response => {
                            // Create a new option
                            const newOption = new Option(response.Description,
                                response.id);
                            // Append the new option to the dropdown
                            $('#description').append(newOption);
                        });
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#Employee').change(function() {
            var empID = $(this).val();
            $.ajax({
                url: '/getemployeelist/' + empID, // Replace with your server URL
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response[0].employeenumber);
                    const employeecode = document.getElementById("empcode");
                    const sssnumber = document.getElementById("sssnumber");
                    const phicnumber = document.getElementById("phicnumber");
                    const hdmfnumber = document.getElementById("hdmfnumber");
                    const loannumber = document.getElementById("loannumber");

                    loannumber.value = response[0].LoanNumber;
                    sssnumber.value = response[0].SSS_Number;
                    phicnumber.value = response[0].PHIC_Number;
                    hdmfnumber.value = response[0].HDMF_Number;
                    employeecode.value = response[0].employeenumber;

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script>
    var date = new Date();
    date.setDate(date.getDate()-1);
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Adjust format as needed
            autoclose: true,
            todayHighlight: true,
            minDate: date
        });
    });
</script>
<script>
        $(document).ready(function () {
            $('#installment').on('keypress', function (event) {
                const inputValue = $(this).val() + String.fromCharCode(event.which);
               
                const partNum = parseFloat(inputValue);
                const loanAmount = parseFloat(document.getElementById("loanAmount").value);
                const deductionAmount = document.getElementById("deductionAmount");
                
                const deducAmt =  loanAmount / partNum ;
                deductionAmount.value = deducAmt.toFixed(2);
               
            });
        });
    </script><?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/deduction/loansdetails/view.blade.php ENDPATH**/ ?>