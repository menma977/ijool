<div class="modal modal-warning fade" id="modal_subscribe" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-600" id="warningModalLabel">IJOOL subscribe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <div class="row">
          <div class="col-md-3">
            <div class="p-2 bg-warning text-black rounded mb-3 p-3 shadow-sm text-center position-relative overflow-hidden">
              <i class="decorative-icon fas fa fa-paw opacity-25 fa-5x animated infinite pulse slower"></i>
              <div class="bg-dark text-white rounded">
                <h4 class="p-2">PRICE {{ $price ?? 0 }} DOGE</h4>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="alert alert-warning" role="alert">
              <p class="mb-0">
                By continuing this transaction,
                <label class="alert-link">winnings and losses</label>
                are completely the
                <label class="alert-link">responsibility of each users</label>.
              </p>
              <p class="mb-0">
                Application <label class="alert-link">is not responsible</label> for transactions made because it's entirely the
                <label class="alert-link">choice of the user</label>.
              </p>
            </div>
          </div>
        </div>
        <p class="mb-0">
          <b>This subscription will be automatically renewed, unsubscribe to stop.</b>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <a href="{{ route("subscribe.agree") }}" class="btn btn-success">Agree</a>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-warning fade" id="modal_withdraw_bot" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-600" id="warningModalLabel">Send Balance To Bot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route("doge.transfer", ["bot", 0]) }}">
          @csrf
          <div class="form-group">
            <label for="amount" class="font-weight-600">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ old("amount") }}">
            @error("amount")
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" class="btn btn-warning btn-block">Send</button>
        </form>
        <hr/>
        <form method="post" action="{{ route("doge.transfer", ["bot", 1]) }}">
          @csrf
          <button type="submit" class="btn btn-warning btn-block">Send All</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-warning fade" id="modal_withdraw_doge" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-600" id="warningModalLabel">Send Balance To Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route("doge.transfer", ["doge", 0]) }}">
          @csrf
          <div class="form-group">
            <label for="amount" class="font-weight-600">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ old("amount") }}">
            @error("amount")
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" class="btn btn-warning btn-block">Send</button>
        </form>
        <hr/>
        <form method="post" action="{{ route("doge.transfer", ["doge", 1]) }}">
          @csrf
          <button type="submit" class="btn btn-warning btn-block">Send All</button>
        </form>
      </div>
    </div>
  </div>
</div>