<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            Payroll: {{ $payroll->title }} ({{ $payroll->status }})
        </h6>
        <div>
            <a href="#" class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById('approve-form').submit();">
                <i class="fas fa-check"></i> Approve
            </a>
            <form id="approve-form" action="{{ route('payroll.approve', $payroll) }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Period:</strong> {{ $payroll->period_start->format('M d, Y') }} to {{ $payroll->period_end->format('M d, Y') }}</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('payroll.export-pdf', $payroll) }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>

        <!-- Add Employee Form -->
        <form action="{{ route('payroll.add-employee', $payroll) }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <select name="employee_id" class="form-control" required>
                    <option value="">Select Employee to Add</option>
                    @foreach(Employee::active()->whereNotIn('id', $payroll->items->pluck('employee_id'))->get() as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </div>
        </form>

        <!-- Payroll Items Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-light">
                        <th>Employee</th>
                        <th>Base Salary</th>
                        <th>Bonuses</th>
                        <th>Deductions</th>
                        <th>Tax</th>
                        <th>Net Pay</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payroll->items as $item)
                    <tr>
                        <td>{{ $item->employee->name }}</td>
                        <td>{{ number_format($item->base_salary, 2) }}</td>
                        <td><input type="number" name="bonuses" value="{{ $item->bonuses }}" class="form-control form-control-sm"></td>
                        <td><input type="number" name="deductions" value="{{ $item->deductions }}" class="form-control form-control-sm"></td>
                        <td>{{ number_format($item->tax, 2) }}</td>
                        <td>{{ number_format($item->net_pay, 2) }}</td>
                        <td>
                            <form action="{{ route('payroll.remove-employee', ['payroll' => $payroll, 'employee' => $item->employee]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-light">
                        <td colspan="5" class="text-right"><strong>Total</strong></td>
                        <td><strong>{{ number_format($payroll->items->sum('net_pay'), 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>




