@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route("user.profile") }}">Profile</a></li>
      <li class="breadcrumb-item active">Blank</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-user text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Your Mate</h1>
        <small>this page to edit your password and profile</small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <ul id="tree">
        <li class="branch">
          <a href="#" id="new-{{ \Illuminate\Support\Facades\Auth::user()->username }}" onclick="addLine(this)">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
          <ul id="set-{{ \Illuminate\Support\Facades\Auth::user()->username }}">
          </ul>
        </li>
      </ul>
    </div>
  </div>
@endsection

@section("addJs")
  <script>
    $.fn.extend({
      treed: function (o) {

        let openedClass = 'far fa-folder-open';
        let closedClass = 'far fa-folder';

        if (typeof o !== 'undefined') {
          if (typeof o.openedClass !== 'undefined') {
            openedClass = o.openedClass;
          }
          if (typeof o.closedClass !== 'undefined') {
            closedClass = o.closedClass;
          }
        }

        //initialize each of the top levels
        const tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
          const branch = $(this); //li with children ul
          branch.prepend("<i class='indicator far " + closedClass + "'></i>");
          branch.addClass('branch');
          branch.on('click', function (e) {
            if (this === e.target) {
              const icon = $(this).children('i:first');
              icon.toggleClass(openedClass + " " + closedClass);
              $(this).children().children().toggle();
            }
          });
          branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function () {
          $(this).on('click', function () {
            $(this).closest('li').click();
          });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
          $(this).on('click', function (e) {
            $(this).closest('li').click();
            e.preventDefault();
          });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
          $(this).on('click', function (e) {
            $(this).closest('li').click();
            e.preventDefault();
          });
        });
      }
    });

    $('#tree').treed({openedClass: 'fas fa-minus', closedClass: 'fas fa-plus'});

    function addLine(e) {
      let sponsor = $(e);
      let idSponsor = $(e).attr("id");
      if (idSponsor.indexOf("new-") !== -1) {
        idSponsor = idSponsor.replace("new-", "");
        $(e).attr("id", idSponsor);
        let url = "{{ route("line.show", "#data#") }}";
        url = url.replace("#data#", idSponsor);
        $.ajax(url, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
            "pragma": 'no-cache',
            "cache-control": 'no-cache',
            "X-Requested-With": "XMLHttpRequest",
          }
        }).done(async function (response) {
          // sponsor.prepend("<i class='indicator fas fa-minus'></i>");
          sponsor.addClass('branch');
          sponsor.on('click', function (e) {
            if (this === e.target) {
              const icon = $(this).children('i:first');
              icon.toggleClass("fas fa-minus  fas fa-plus");
              $(this).children().children().toggle();
            }
          });
          sponsor.children().children().toggle();

          let html = "";
          response.line.forEach(element => {
            html += '<li id="new-' + element.user.username + '" onclick="addLine(this)"><a href="#">' + element.user.name + '</a><ul id="set-' + element.user.username + '"></ul></li>'
          });
          $("#set-" + idSponsor).html(html);
        }).fail((e) => {
          console.log(e);
        });
      }
    }
  </script>
@endsection