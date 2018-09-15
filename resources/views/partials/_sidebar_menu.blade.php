<ul class="sidebar-nav">

    <li class="sidebar-brand">
        {{ trans('lang.main_menu') }}
    </li>

    <li>
        <a href="{{ route('reservations.reservation.index') }}">
            {{ trans('reservations.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('reservation_pickups.reservation_pickup.index') }}">
            {{ trans('reservations.pickup') }}
        </a>
    </li>

    <li>
        <a href="{{ route('reservation_dropoffs.reservation_dropoff.index') }}">
            {{ trans('reservations.dropoff') }}
        </a>
    </li>

    <li>
        <a href="{{ route('asset_categories.asset_category.index') }}">
            {{ trans('asset_categories.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('assets.asset.index') }}">
            {{ trans('assets.model_plural') }}
        </a>
    </li>


    <li>
        <a href="{{ route('brands.brand.index') }}">
            {{ trans('brands.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('checks.check.index') }}">
            {{ trans('checks.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('vehicle_sizes.vehicle_size.index') }}">
            {{ trans('vehicle_sizes.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('credit_payments.credit_payment.index') }}">
            {{ trans('credit_payments.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('credits.credit.index') }}">
            {{ trans('credits.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('customers.customer.index') }}">
            {{ trans('customers.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('expense_categories.expense_category.index') }}">
            {{ trans('expense_categories.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('expenses.expense.index') }}">
            {{ trans('expenses.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('maintenance_categories.maintenance_category.index') }}">
            {{ trans('maintenance_categories.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('maintenance_records.maintenance_record.index') }}">
            {{ trans('maintenance_records.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('payable_checks.payable_check.index') }}">
            {{ trans('payable_checks.model_plural') }}
        </a>
    </li>

    <li>
        <a href="{{ route('vehicles.vehicle.index') }}">
            {{ trans('vehicles.model_plural') }}
        </a>
    </li>

</ul>
