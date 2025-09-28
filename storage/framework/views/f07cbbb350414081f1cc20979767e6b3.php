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
    <?php $__env->startSection('title', 'View Loan Details'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Loan</h3>
            <div class="card-tools"><a href="<?php echo e(route('deductions.loans.index')); ?>" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped" id="loanTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loan Date</th>
                                <th>Type of Loan</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Amount Paid</th>
                                <th>Balances</th>
                                <th>Date Deducted</th>
                                <th>Status</th>
                                <th>ProcessBy</th>
                                <th>Date Processed</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ltDet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                    <td><?php echo e($ltDet->id); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($ltDet->LoanDate)->format('m-d-Y')); ?></td>
                                    <td><?php echo e($ltDet->LoanType); ?></td>
                                    <td><?php echo e($ltDet->Description); ?> </td>
                                    <td><?php echo e(number_format($ltDet->Amount,2)); ?></td>
                                    <td><?php echo e(number_format($ltDet->AmountPaid,2)); ?></td>
                                    <td><?php echo e(number_format($ltDet->Balances,2)); ?></td>
                                    <td><?php echo e($ltDet->Status == -1 ? "No Payslip Yet":"PaySlip #: ".$ltDet->Status); ?></td>
                                    <td><?php echo e($ltDet->DateDeducted); ?></td>
                                    <td><?php echo e($ltDet->ProcessedBy); ?></td>
                                    <td><?php echo e($ltDet->ProcessedDate); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
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
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script>
    var date = new Date();
    date.setDate(date.getDate() - 1);
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
    $(document).ready(function() {
        $('#installment').on('keypress', function(event) {
            const inputValue = $(this).val() + String.fromCharCode(event.which);

            const partNum = parseFloat(inputValue);
            const loanAmount = parseFloat(document.getElementById("loanAmount").value);
            const deductionAmount = document.getElementById("deductionAmount");

            const deducAmt = loanAmount / partNum;
            deductionAmount.value = deducAmt.toFixed(2);

        });
    });
</script>
<?php /**PATH D:\PAYROLL\PS\adminlte-laravel10\resources\views/deduction/loans/view.blade.php ENDPATH**/ ?>