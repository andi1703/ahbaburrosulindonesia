          </div>
          <!-- / Content -->
          <div class="content-backdrop fade"></div>
        </div>
        <!-- / Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <script src="<?= base_url('assets/assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('assets/assets/vendor/libs/popper/popper.js') ?>"></script>
  <script src="<?= base_url('assets/assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
  <script src="<?= base_url('assets/assets/vendor/js/menu.js') ?>"></script>
  <script src="<?= base_url('assets/assets/js/main.js') ?>"></script>

  <script>
    // Membuka fitur Premium: Paksa fungsi Collapse & Hover di Desktop (Bypass limitasi Free Version)
    document.addEventListener('DOMContentLoaded', function() {
      var customToggle = document.getElementById('custom-sidebar-toggle');
      var htmlElement = document.documentElement;
      var layoutMenu = document.getElementById('layout-menu');

      if(customToggle) {
        customToggle.addEventListener('click', function(e) {
          e.preventDefault();
          // Hanya berlaku untuk layar besar (Desktop)
          if (window.innerWidth >= 1200) {
            htmlElement.classList.toggle('layout-menu-collapsed');
            
            // Efek panah berputar saat ditarik
            var toggleIcon = customToggle.querySelector('i');
            if(htmlElement.classList.contains('layout-menu-collapsed')) {
              toggleIcon.style.transform = 'rotate(180deg)';
            } else {
              toggleIcon.style.transform = 'rotate(0deg)';
            }
          }
        });
      }

      // Fitur Premium: Hover membesar sementara saat mode ciut
      if (layoutMenu) {
        layoutMenu.addEventListener('mouseenter', function() {
          if (window.innerWidth >= 1200 && htmlElement.classList.contains('layout-menu-collapsed')) {
            htmlElement.classList.add('layout-menu-hover');
          }
        });
        layoutMenu.addEventListener('mouseleave', function() {
          if (window.innerWidth >= 1200 && htmlElement.classList.contains('layout-menu-collapsed')) {
            htmlElement.classList.remove('layout-menu-hover');
          }
        });
      }
    });
  </script>

  <style>
  /* Global Custom Toast Scoped CSS */
  .custom-toast-wrapper {
      width: 380px;
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      display: none;
  }
  .custom-toast {
      width: 100%;
      height: auto;
      min-height: 80px;
      padding: 15px 20px;
      background-color: #ffffff;
      border-radius: 7px;
      display: grid;
      grid-template-columns: 1.3fr 6fr 0.5fr;
      box-shadow: 0 15px 30px rgba(0,0,0,0.08);
      align-items: center;
  }
  .custom-toast.success { border-left: 8px solid #47D764; }
  .custom-toast.error { border-left: 8px solid #ff355b; }
  .custom-toast.info { border-left: 8px solid #2F86EB; }
  .custom-toast.warning { border-left: 8px solid #FFC021; }

  .custom-toast .container-1, .custom-toast .container-2 { align-self: center; }
  .custom-toast .container-1 i { font-size: 35px; }

  .custom-toast.success .container-1 i { color: #47D764; }
  .custom-toast.error .container-1 i { color: #ff355b; }
  .custom-toast.info .container-1 i { color: #2F86EB; }
  .custom-toast.warning .container-1 i { color: #FFC021; }

  .custom-toast .container-2 p:first-child {
      color: #101020;
      font-weight: 600;
      font-size: 16px;
      margin: 0;
      line-height: 1.2;
  }
  .custom-toast .container-2 p:last-child {
      font-size: 13px;
      font-weight: 400;
      color: #656565;
      margin: 0;
      margin-top: 4px;
      line-height: 1.4;
  }
  .custom-toast button {
      align-self: flex-start;
      background-color: transparent;
      font-size: 25px;
      color: #656565;
      line-height: 0;
      cursor: pointer;
      border: none;
      margin-top: -5px;
  }
  </style>

  <!-- Global Custom Toast Wrapper -->
  <div class="custom-toast-wrapper" id="globalCustomToast">
      <div class="custom-toast" id="globalToastBody">
          <div class="container-1">
              <i class="" id="globalToastIcon"></i>
          </div>
          <div class="container-2">
              <p id="globalToastTitle">Success</p>
              <p id="globalToastMessage">Message here</p>
          </div>
          <button onclick="closeGlobalToast()">&times;</button>
      </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <script>
    let globalToastTimeout;

    function showGlobalToast(type, title, message) {
        clearTimeout(globalToastTimeout);
        const toastBody = $('#globalToastBody');
        const icon = $('#globalToastIcon');
        
        // Reset classes
        toastBody.removeClass('success error info warning');
        icon.removeClass();

        // Apply new styles
        toastBody.addClass(type);
        if(type === 'success') icon.addClass('fas fa-check-circle');
        if(type === 'error') icon.addClass('fas fa-times-circle');
        if(type === 'info') icon.addClass('fas fa-info-circle');
        if(type === 'warning') icon.addClass('fas fa-exclamation-circle');

        $('#globalToastTitle').text(title);
        $('#globalToastMessage').html(message); // Allows HTML like <strong> from Flashdata

        $('#globalCustomToast').fadeIn(300);
        
        globalToastTimeout = setTimeout(function() {
            closeGlobalToast();
        }, 4000);
    }

    function closeGlobalToast() {
        $('#globalCustomToast').fadeOut(300);
    }

    // Intercept default Bootstrap Alerts from CI Flashdata
    $(document).ready(function() {
        // Find existing alerts (usually created by CI flashdata)
        const alerts = $('.alert');
        if(alerts.length > 0) {
            alerts.each(function() {
                const alertEl = $(this);
                
                // Skip if it's inside another specific component we don't want to convert
                // For now, we convert all standard flashdata alerts.
                
                let type = 'info';
                let title = 'Info';
                
                if(alertEl.hasClass('alert-success')) {
                    type = 'success';
                    title = 'Success';
                } else if(alertEl.hasClass('alert-danger')) {
                    type = 'error';
                    title = 'Error';
                } else if(alertEl.hasClass('alert-warning')) {
                    type = 'warning';
                    title = 'Warning';
                }

                // Clean up the message (remove the alert div wrapper if it got outputted, though usually flashdata IS the alert div)
                // In CI, flashdata is often: <div class="alert alert-success">Message</div>
                // So the text/html inside alertEl is our message
                const message = alertEl.html();

                // Hide the original alert
                alertEl.hide();
                // If it's wrapped in a spacing div, hide that too
                if(alertEl.parent().hasClass('card-body') && alertEl.parent().children(':visible').length === 0) {
                    alertEl.parent().hide();
                }

                // Show Global Toast
                setTimeout(() => {
                    showGlobalToast(type, title, message);
                }, 100);
            });
        }
    });
  </script>
</body>
</html>
