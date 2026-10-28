<!-- Tour Booking Modal -->
<div id="bookingModalOverlay" class="booking-modal-overlay" style="display: none;">
    <div class="booking-modal-card">
        <div class="booking-modal-header">
            <div>
                <span class="modal-badge"><i class="ri-flight-takeoff-line"></i> Reservation Inquiry</span>
                <h3 id="modalTourTitle">Book Your Tour</h3>
            </div>
            <button type="button" class="modal-close-btn" id="closeBookingModal">&times;</button>
        </div>

        <div id="bookingModalAlert" class="booking-modal-alert" style="display: none;"></div>

        <form id="tourBookingForm" action="submit_inquiry.php" method="POST">
            <input type="hidden" name="type" value="Tour Booking">
            <input type="hidden" name="tour_name" id="modalTourNameInput" value="">

            <div class="booking-form-grid">
                <div class="booking-field">
                    <label for="book_name">Full Name *</label>
                    <input type="text" id="book_name" name="name" class="booking-input" placeholder="e.g. Sarah Jenkins" required>
                </div>
                <div class="booking-field">
                    <label for="book_email">Email Address *</label>
                    <input type="email" id="book_email" name="email" class="booking-input" placeholder="e.g. sarah@example.com" required>
                </div>
            </div>

            <div class="booking-form-grid">
                <div class="booking-field">
                    <label for="book_phone">Phone / WhatsApp *</label>
                    <input type="text" id="book_phone" name="phone" class="booking-input" placeholder="+1 (555) 123-4567" required>
                </div>
                <div class="booking-field">
                    <label for="book_travelers">Number of Travelers</label>
                    <select id="book_travelers" name="travelers" class="booking-select">
                        <option value="1">1 Traveler (Solo)</option>
                        <option value="2" selected>2 Travelers (Couple)</option>
                        <option value="3">3 Travelers</option>
                        <option value="4">4 Travelers (Family / Small Group)</option>
                        <option value="5">5+ Travelers (Group Tour)</option>
                    </select>
                </div>
            </div>

            <div class="booking-field">
                <label for="book_date">Preferred Departure Date</label>
                <input type="date" id="book_date" name="travel_date" class="booking-input" min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="booking-field">
                <label for="book_message">Special Requests or Notes</label>
                <textarea id="book_message" name="message" rows="3" class="booking-textarea" placeholder="Dietary needs, airport transfer, custom dates, or hotel tier preferences..."></textarea>
            </div>

            <button type="submit" id="bookSubmitBtn" class="booking-submit-btn">
                <i class="ri-check-line"></i> Confirm Booking Request
            </button>
        </form>
    </div>
</div>

<style>
    .booking-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(4, 7, 16, 0.78);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .booking-modal-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    .booking-modal-card {
        background: #101524;
        border: 1px solid rgba(255, 163, 67, 0.3);
        border-radius: 20px;
        width: 100%;
        max-width: 540px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 32px 30px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(255, 163, 67, 0.15);
        transform: translateY(20px) scale(0.96);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        color: #fff;
    }

    .booking-modal-overlay.active .booking-modal-card {
        transform: translateY(0) scale(1);
    }

    .booking-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 22px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-badge {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: var(--main-color, #ffa343);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
    }

    .booking-modal-header h3 {
        font-family: var(--h2-font-family, 'Playfair Display', serif);
        font-size: 1.6rem;
        margin: 0;
        color: #fff;
    }

    .modal-close-btn {
        background: rgba(255, 255, 255, 0.08);
        border: none;
        color: #aaa;
        font-size: 26px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        line-height: 1;
    }

    .modal-close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .booking-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    @media (max-width: 520px) {
        .booking-form-grid {
            grid-template-columns: 1fr;
        }
    }

    .booking-field {
        margin-bottom: 16px;
    }

    .booking-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, 0.8);
    }

    .booking-input, .booking-select, .booking-textarea {
        width: 100%;
        padding: 11px 14px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: all 0.25s ease;
    }

    .booking-input:focus, .booking-select:focus, .booking-textarea:focus {
        border-color: var(--main-color, #ffa343);
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 10px rgba(255, 163, 67, 0.25);
    }

    .booking-select option {
        background: #101524;
        color: #fff;
    }

    .booking-submit-btn {
        width: 100%;
        padding: 14px;
        background: var(--main-color, #ffa343);
        color: #111;
        font-weight: 700;
        font-size: 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .booking-submit-btn:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.15);
    }

    .booking-modal-alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .booking-modal-alert.success {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(46, 204, 113, 0.18);
        border: 1px solid rgba(46, 204, 113, 0.4);
        color: #2ecc71;
    }

    .booking-modal-alert.error {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(231, 76, 60, 0.18);
        border: 1px solid rgba(231, 76, 60, 0.4);
        color: #e74c3c;
    }
</style>

<script>
    (function() {
        const overlay = document.getElementById('bookingModalOverlay');
        const closeBtn = document.getElementById('closeBookingModal');
        const modalTitle = document.getElementById('modalTourTitle');
        const tourInput = document.getElementById('modalTourNameInput');
        const form = document.getElementById('tourBookingForm');
        const submitBtn = document.getElementById('bookSubmitBtn');
        const alertBox = document.getElementById('bookingModalAlert');

        function openBookingModal(tourName) {
            modalTitle.textContent = tourName ? 'Book: ' + tourName : 'Book Your Tour';
            tourInput.value = tourName || 'Tour Package';
            alertBox.style.display = 'none';
            overlay.style.display = 'flex';
            setTimeout(() => overlay.classList.add('active'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeBookingModalFn() {
            overlay.classList.remove('active');
            setTimeout(() => {
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }, 300);
        }

        closeBtn.addEventListener('click', closeBookingModalFn);
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeBookingModalFn();
            }
        });

        // Attach to all elements with class 'open-booking-modal'
        document.querySelectorAll('.open-booking-modal').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const tour = this.getAttribute('data-tour') || 'Featured Tour';
                openBookingModal(tour);
            });
        });

        // Form submission via AJAX
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Processing...';
            alertBox.style.display = 'none';

            const formData = new FormData(form);
            formData.append('is_ajax', '1');

            fetch('submit_inquiry.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;

                if (data.status === 'success') {
                    alertBox.className = 'booking-modal-alert success';
                    alertBox.innerHTML = '<i class="ri-checkbox-circle-fill"></i> <span>' + data.message + '</span>';
                    alertBox.style.display = 'flex';
                    form.reset();
                    setTimeout(() => {
                        closeBookingModalFn();
                    }, 2500);
                } else {
                    alertBox.className = 'booking-modal-alert error';
                    alertBox.innerHTML = '<i class="ri-error-warning-fill"></i> <span>' + (data.message || 'Error submitting booking.') + '</span>';
                    alertBox.style.display = 'flex';
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                alertBox.className = 'booking-modal-alert error';
                alertBox.innerHTML = '<i class="ri-error-warning-fill"></i> <span>Network error. Please try again.</span>';
                alertBox.style.display = 'flex';
            });
        });
    })();
</script>
