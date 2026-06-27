
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Loan Collection</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:14px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,
        td{
            border:1px solid #000;
            padding:8px;
        }

        th{
            width:35%;
            text-align:left;
            background:#f2f2f2;
        }

    </style>

</head>

<body>

<h2>Loan Collection Details</h2>

<table>

<tr>
    <th>Collection ID</th>
    <td>{{ $loanCollection->id }}</td>
</tr>

<tr>
    <th>Loan ID</th>
    <td>{{ $loanCollection->loan_section_id }}</td>
</tr>

<tr>
    <th>Member Name</th>
    <td>{{ $loanCollection->member->name ?? 'N/A' }}</td>
</tr>

<tr>
    <th>Member Code</th>
    <td>{{ $loanCollection->member_code }}</td>
</tr>

<tr>
    <th>Collected By</th>
    <td>{{ $loanCollection->employee->name ?? 'N/A' }}</td>
</tr>

<tr>
    <th>Installment Amount</th>
    <td>{{ number_format($loanCollection->installment_amount,2) }}</td>
</tr>

<tr>
    <th>Paid Amount</th>
    <td>{{ number_format($loanCollection->paid_amount,2) }}</td>
</tr>

<tr>
    <th>Penalty Charge</th>
    <td>{{ number_format($loanCollection->penalty_charge,2) }}</td>
</tr>

<tr>
    <th>Installment Date</th>
    <td>{{ $loanCollection->installment_date }}</td>
</tr>

<tr>
    <th>Paid Date</th>
    <td>{{ $loanCollection->paid_date }}</td>
</tr>

<tr>
    <th>Expire Date</th>
    <td>{{ $loanCollection->expire_date }}</td>
</tr>

<tr>
    <th>Status</th>
    <td>{{ ucfirst($loanCollection->status) }}</td>
</tr>

<tr>
    <th>Remark</th>
    <td>{{ $loanCollection->remark }}</td>
</tr>

<tr>
    <th>Created At</th>
    <td>{{ $loanCollection->created_at->format('d M Y h:i A') }}</td>
</tr>

</table>

</body>
</html> 
