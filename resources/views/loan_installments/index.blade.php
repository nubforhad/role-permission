@extends('layouts.app')

@section('content')

<div class="page-wrapper">
<div class="page-content">

    <div class="card">
        <div class="card-header">
            <h4>Loan Installment Collection</h4>
        </div>

        <div class="card-body">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- SEARCH SECTION --}}
            <div class="row mb-3">

                <div class="col-md-6">
                    <label>Member Code</label>
                    <input type="text" id="member_code" class="form-control" placeholder="Enter Member Code">
                </div>

                <div class="col-md-2 mt-4">
                    <button class="btn btn-primary mt-2" onclick="searchMember()">
                        Search
                    </button>
                </div>

            </div>

            <hr>

            {{-- RESULT AREA --}}
            <div id="result" style="display:none;">

                {{-- MEMBER INFO --}}
                <h5>Member Info</h5>
                <p id="member_info"></p>

                {{-- LOAN INFO --}}
                <h5>Loan Info</h5>
                <p id="loan_info"></p>

                {{-- INSTALLMENT INFO --}}
                <h5>Installment Details</h5>

                <form method="POST" action="{{ url('/loan-installments/pay') }}">
                    @csrf

                    <input type="hidden" name="installment_id" id="installment_id">

                    <table class="table table-bordered">

                        <tr>
                            <th>Installment No</th>
                            <td id="inst_no"></td>
                        </tr>

                        <tr>
                            <th>Amount</th>
                            <td id="amount"></td>
                        </tr>

                        <tr>
                            <th>Paid Amount</th>
                            <td id="paid"></td>
                        </tr>

                        <tr>
                            <th>Due Amount</th>
                            <td id="due"></td>
                        </tr>

                        <tr>
                            <th>Due Date</th>
                            <td id="due_date"></td>
                        </tr>

                    </table>

                    {{-- PAYMENT INPUT --}}
                    <div class="row">

                        <div class="col-md-4">
                            <label>Pay Amount</label>
                            <input type="number" step="0.01" name="paid_amount" class="form-control" required>
                        </div>

                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-success mt-2">
                                Pay Installment
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
</div>

{{-- AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function searchMember()
{
    let code = $('#member_code').val();

    if(code == ''){
        alert('Please enter member code');
        return;
    }

    $.ajax({
        url: "{{ url('/loan-installments/search') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            member_code: code
        },

        success: function(res) {

            if(!res.status){
                alert(res.message);
                $('#result').hide();
                return;
            }

            $('#result').show();

            // MEMBER
            $('#member_info').html(
                res.member.member_name + " (" + res.member.member_code + ")"
            );

            // LOAN
            $('#loan_info').html(
                "Loan: " + res.loan.loan_amount +
                " | EMI: " + res.loan.emi_amount
            );

            // INSTALLMENT
            let inst = res.installment;

            if(!inst){
                alert("No pending installment found");
                return;
            }

            $('#installment_id').val(inst.id);

            $('#inst_no').text(inst.installment_no);
            $('#amount').text(inst.amount);
            $('#paid').text(inst.paid_amount);
            $('#due').text(inst.due_amount);
            $('#due_date').text(inst.due_date);

        },

        error: function(){
            alert('Something went wrong!');
        }
    });
}
</script>

@endsection