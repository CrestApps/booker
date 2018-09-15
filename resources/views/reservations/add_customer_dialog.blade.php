<!-- Modal -->
<div class="modal fade" id="add_customer_dialog" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('customers.add') }}</h4>
      </div>
      <div class="modal-body">

          <div class="alert alert-danger hidden" id="customer_dialog_error_placeholder">
          </div>

          <form method="POST" action="{{ route('customers.customer.store') }}" accept-charset="UTF-8" id="create_customer_form" name="create_customer_form" class="form-horizontal">
          {{ csrf_field() }}
          @include ('customers.create_form', ['customer' => null])

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-target="create_customer_form" id="submit_create_customer_form">{{ trans('customers.add') }}</button>
      </div>
    </div>

  </div>
</div>
