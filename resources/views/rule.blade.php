@extends("layouts.guest")

@section("content")
  <div class="form-wrapper m-auto">
    <div class="card m-4">
      <div class="card-body">
        <h3 class="mb-4"><a href="{{ url("/") }}" class="text-warning">IJOOL</a> Terms and Conditions of Use</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-terms-tab" data-toggle="pill" href="#v-pills-terms" role="tab" aria-controls="v-pills-terms" aria-selected="true">Terms</a>
              <a class="nav-link" id="v-pills-use_license-tab" data-toggle="pill" href="#v-pills-use_license" role="tab" aria-controls="v-pills-use_license" aria-selected="false">Use License</a>
              <a class="nav-link" id="v-pills-disclaimer-tab" data-toggle="pill" href="#v-pills-disclaimer" role="tab" aria-controls="v-pills-disclaimer" aria-selected="false">Disclaimer</a>
              <a class="nav-link" id="v-pills-limitations-tab" data-toggle="pill" href="#v-pills-limitations" role="tab" aria-controls="v-pills-limitations" aria-selected="false">Limitations</a>
              <a class="nav-link" id="v-pills-revisions_and_errata-tab" data-toggle="pill" href="#v-pills-revisions_and_errata" role="tab" aria-controls="v-pills-revisions_and_errata"
                 aria-selected="false">
                Revisions and Errata
              </a>
              <a class="nav-link" id="v-pills-links-tab" data-toggle="pill" href="#v-pills-links" role="tab" aria-controls="v-pills-links" aria-selected="false">Links</a>
              <a class="nav-link" id="v-pills-site_terms_of_use_modifications-tab" data-toggle="pill" href="#v-pills-site_terms_of_use_modifications" role="tab"
                 aria-controls="v-pills-site_terms_of_use_modifications" aria-selected="false">
                Site Terms of Use Modifications
              </a>
              <a class="nav-link" id="v-pills-governing_law-tab" data-toggle="pill" href="#v-pills-governing_law" role="tab" aria-controls="v-pills-governing_law" aria-selected="false">
                Governing Law
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-terms" role="tabpanel" aria-labelledby="v-pills-terms-tab">
                <p>
                  By accessing this Website, accessible from <span class="text-primary">ijool.net</span>, you are agreeing to be bound by these Website Terms and Conditions of Use
                  and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The
                  materials contained in this Website are protected by copyright and trade mark law.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-use_license" role="tabpanel" aria-labelledby="v-pills-use_license-tab">
                <p>
                  Permission is granted to temporarily download one copy of the materials on <span class="text-primary">IJOOL</span>'s Website for personal, non-commercial
                  transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                </p>
                <ul style="text-align: left !important;">
                  <li>modify or copy the materials;</li>
                  <li>use the materials for any commercial purpose or for any public display;</li>
                  <li>attempt to reverse engineer any software contained on <span class="text-primary">IJOOL</span>'s Website;</li>
                  <li>remove any copyright or other proprietary notations from the materials; or</li>
                  <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
                </ul>
                <p>
                  This will let <span class="text-primary">IJOOL</span> to terminate upon violations of any of these restrictions. Upon termination, your viewing right will
                  also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-disclaimer" role="tabpanel" aria-labelledby="v-pills-disclaimer-tab">
                <p>
                  All the materials on <span class="text-primary">IJOOL</span>'s Website are provided “as is”.
                  <span class="text-primary">IJOOL</span> makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore,
                  <span class="text-primary">IJOOL</span> does not make any representations concerning the accuracy or reliability of the use of the materials on its Website
                  or
                  otherwise relating to such materials or any sites linked to this Website.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-limitations" role="tabpanel" aria-labelledby="v-pills-limitations-tab">
                <p>
                  <span class="text-primary">IJOOL</span> or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the
                  materials on <span class="text-primary">IJOOL</span>'s Website, even if <span class="text-primary">IJOOL</span> or an authorize
                  representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or
                  limitations of liability for incidental damages, these limitations may not apply to you.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-revisions_and_errata" role="tabpanel" aria-labelledby="v-pills-revisions_and_errata-tab">
                <p>
                  The materials appearing on <span class="text-primary">IJOOL</span>'s Website may include technical, typographical, or photographic errors.
                  <span class="text-primary">IJOOL</span> will not promise that any of the materials in this Website are accurate, complete, or current.
                  <span class="text-primary">IJOOL</span> may change the materials contained on its Website at any time without notice.
                  <span class="text-primary">IJOOL</span> does not make any commitment to update the materials.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-links" role="tabpanel" aria-labelledby="v-pills-links-tab">
                <p>
                  <span class="text-primary">IJOOL</span> has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked
                  site. The presence of any link does not imply endorsement by <span class="text-primary">IJOOL</span> of the site. The use of any linked website is at the
                  user's own risk.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-site_terms_of_use_modifications" role="tabpanel" aria-labelledby="v-pills-site_terms_of_use_modifications-tab">
                <p>
                  <span class="text-primary">IJOOL</span> may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are
                  agreeing to be bound by the current version of these Terms and Conditions of Use.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-governing_law" role="tabpanel" aria-labelledby="v-pills-governing_law-tab">
                <p>
                  Any claim related to <span class="text-primary">IJOOL</span>'s Website shall be governed by the laws of
                  <span class="highlight preview_country">Country</span> without regards to its conflict of law provisions.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
