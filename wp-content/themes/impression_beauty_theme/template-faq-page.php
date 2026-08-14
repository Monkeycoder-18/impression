<?php
/*
 * Template Name: FAQ Page
 * Template Post Type: page
 */
get_header();
?>

<!-- FAQ HERO -->
<section class="inner-page-hero inner-page-hero--faq">
    <div class="container text-center">
        <span class="badge-beauty">Help Centre</span>
        <h1 class="inner-page-hero-title mt-3">
            Frequently Asked <span>Questions</span>
        </h1>
        <p class="inner-page-hero-sub mx-auto">
            Everything you need to know about our treatments, appointments, and services.
            Can't find an answer?
            <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="inner-page-hero-link">Contact us</a>.
        </p>
    </div>
</section>

<!-- FAQ CATEGORY TABS -->
<section class="py-5">
    <div class="container">

        <!-- Tab Navigation -->
        <ul class="nav faq-tabs justify-content-center mb-5 flex-wrap gap-2" id="faqTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="faq-tab-btn active"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-general"
                        type="button" role="tab"
                        aria-controls="tab-general"
                        aria-selected="true">
                    General
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="faq-tab-btn"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-face"
                        type="button" role="tab"
                        aria-controls="tab-face"
                        aria-selected="false">
                    Face Care
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="faq-tab-btn"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-body"
                        type="button" role="tab"
                        aria-controls="tab-body"
                        aria-selected="false">
                    Body Care
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="faq-tab-btn"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-hair"
                        type="button" role="tab"
                        aria-controls="tab-hair"
                        aria-selected="false">
                    Hair Removal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="faq-tab-btn"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-skin"
                        type="button" role="tab"
                        aria-controls="tab-skin"
                        aria-selected="false">
                    Skin Growth Removal
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- ── GENERAL ── -->
            <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <p class="faq-category-label">Consultation</p>
                        <div class="accordion faq-accordion" id="accordionGeneral">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#gen1"
                                            aria-expanded="true">
                                        What is covered in a free skin analysis?
                                    </button>
                                </h2>
                                <div id="gen1" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                                    <div class="accordion-body faq-body">
                                        <ul class="faq-list">
                                            <li>Skin check</li>
                                            <li>Advice on your skin type</li>
                                            <li>Advice on how to best care for your skin</li>
                                            <li>Recommendations for treatments that suit your skin</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p class="faq-category-label mt-5">Appointments</p>
                        <div class="accordion faq-accordion" id="accordionAppointments">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#appt1">
                                        How can I make or change an appointment?
                                    </button>
                                </h2>
                                <div id="appt1" class="accordion-collapse collapse" data-bs-parent="#accordionAppointments">
                                    <div class="accordion-body faq-body">
                                        <p>Call us at <strong>+65 6333 9093</strong> during business hours, or email us at <strong>imp@impressionbeauty.com.sg</strong>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#appt2">
                                        Are you open on weekends and public holidays?
                                    </button>
                                </h2>
                                <div id="appt2" class="accordion-collapse collapse" data-bs-parent="#accordionAppointments">
                                    <div class="accordion-body faq-body">
                                        <p>Yes! Our operating hours are:</p>
                                        <ul class="faq-list">
                                            <li>Mon – Fri: 11:30am – 9:00pm</li>
                                            <li>Sat &amp; Sun: 10:00am – 6:00pm</li>
                                            <li>Public Holidays: 10:00am – 5:30pm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#appt3">
                                        Do you accept male customers?
                                    </button>
                                </h2>
                                <div id="appt3" class="accordion-collapse collapse" data-bs-parent="#accordionAppointments">
                                    <div class="accordion-body faq-body">
                                        <p>Yes, we welcome all customers regardless of gender. Please call us to enquire about specific treatments available.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p class="faq-category-label mt-5">Payment</p>
                        <div class="accordion faq-accordion" id="accordionPayment">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#pay1">
                                        What payment methods do you accept?
                                    </button>
                                </h2>
                                <div id="pay1" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
                                    <div class="accordion-body faq-body">
                                        <p>We accept <strong>Cash, NETS</strong>, and all major <strong>credit &amp; debit cards</strong>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#pay2">
                                        Can I buy a treatment package for a friend?
                                    </button>
                                </h2>
                                <div id="pay2" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
                                    <div class="accordion-body faq-body">
                                        <p>Yes! Please contact us at <strong>+65 6333 9093</strong> or email <strong>imp@impressionbeauty.com.sg</strong> to arrange a gift package.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- ── FACE CARE ── -->
            <div class="tab-pane fade" id="tab-face" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="faq-tab-intro mb-4">
                            <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Face-Set-Image-scaled.jpg"
                                 alt="Face Care"
                                 class="faq-tab-intro-img">
                        </div>

                        <div class="accordion faq-accordion" id="accordionFace">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#face1"
                                            aria-expanded="true">
                                        Can I do a facial when I have a skin allergy?
                                    </button>
                                </h2>
                                <div id="face1" class="accordion-collapse collapse show" data-bs-parent="#accordionFace">
                                    <div class="accordion-body faq-body">
                                        <p>It depends on the type of allergy. Generally, it is not advisable to proceed during an active allergic reaction. We recommend consulting a dermatologist first, then booking a free skin analysis with our therapists so we can assess the safest approach for you.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#face2">
                                        Does facial treatment work for all skin types?
                                    </button>
                                </h2>
                                <div id="face2" class="accordion-collapse collapse" data-bs-parent="#accordionFace">
                                    <div class="accordion-body faq-body">
                                        <p>Yes. We offer tailored facial treatments for all skin types — oily, dry, combination, sensitive, and mature skin. Our therapists will recommend the most suitable treatment after your complimentary skin analysis.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#face3">
                                        How long does a typical facial treatment last?
                                    </button>
                                </h2>
                                <div id="face3" class="accordion-collapse collapse" data-bs-parent="#accordionFace">
                                    <div class="accordion-body faq-body">
                                        <p>Most facial treatments last between <strong>60 to 90 minutes</strong>, depending on the type selected. Specialised treatments may be longer — our team will advise you during your consultation.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#face4">
                                        I have broken veins on my face — can I get rid of them?
                                    </button>
                                </h2>
                                <div id="face4" class="accordion-collapse collapse" data-bs-parent="#accordionFace">
                                    <div class="accordion-body faq-body">
                                        <p>Depending on the severity, some treatments can help reduce the appearance of broken veins. We recommend booking a skin consultation first so our therapists can assess and recommend the best approach.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#face5">
                                        I am pregnant — can I have facial treatments?
                                    </button>
                                </h2>
                                <div id="face5" class="accordion-collapse collapse" data-bs-parent="#accordionFace">
                                    <div class="accordion-body faq-body">
                                        <p>Some facial treatments are safe during pregnancy while others are not. Please let our team know you are pregnant when booking, and our therapists will advise on the most suitable options.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ── BODY CARE ── -->
            <div class="tab-pane fade" id="tab-body" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="faq-tab-intro mb-4">
                            <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Body-Set-Image-scaled.jpg"
                                 alt="Body Care"
                                 class="faq-tab-intro-img">
                        </div>

                        <div class="accordion faq-accordion" id="accordionBody">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#body1"
                                            aria-expanded="true">
                                        I have stretch marks — can I get rid of them?
                                    </button>
                                </h2>
                                <div id="body1" class="accordion-collapse collapse show" data-bs-parent="#accordionBody">
                                    <div class="accordion-body faq-body">
                                        <p>It depends on the colour of the marks. <strong>Pink or dark stretch marks</strong> typically respond better to treatment. <strong>Silver (white) stretch marks</strong> are generally harder to treat. Our therapists will assess your concern and recommend the most suitable treatment plan.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#body2">
                                        What should I wear for a body treatment?
                                    </button>
                                </h2>
                                <div id="body2" class="accordion-collapse collapse" data-bs-parent="#accordionBody">
                                    <div class="accordion-body faq-body">
                                        <p>We recommend wearing comfortable, loose-fitting clothing. We will provide appropriate garments or draping for the treatment area to ensure your comfort and privacy throughout the session.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#body3">
                                        I am pregnant — can I have body treatments?
                                    </button>
                                </h2>
                                <div id="body3" class="accordion-collapse collapse" data-bs-parent="#accordionBody">
                                    <div class="accordion-body faq-body">
                                        <p>Certain body treatments are not recommended during pregnancy, especially during the first trimester. Please inform our team when booking, and our therapists will advise on the safest options available for you.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ── HAIR REMOVAL ── -->
            <div class="tab-pane fade" id="tab-hair" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="faq-tab-intro mb-4">
                            <img src="https://images.unsplash.com/photo-1653784097013-786a8965ea3b?w=900&h=280&fit=crop&q=80"
                                 alt="Hair Removal"
                                 class="faq-tab-intro-img">
                        </div>

                        <div class="accordion faq-accordion" id="accordionHair">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#hair1"
                                            aria-expanded="true">
                                        Is hair removal treatment painful?
                                    </button>
                                </h2>
                                <div id="hair1" class="accordion-collapse collapse show" data-bs-parent="#accordionHair">
                                    <div class="accordion-body faq-body">
                                        <p>Our hair removal treatments are designed to minimise discomfort. Most clients experience only a mild warming or tingling sensation during the procedure. Our therapists will ensure your comfort throughout the session.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#hair2">
                                        How many sessions are needed for lasting results?
                                    </button>
                                </h2>
                                <div id="hair2" class="accordion-collapse collapse" data-bs-parent="#accordionHair">
                                    <div class="accordion-body faq-body">
                                        <p>The number of sessions varies based on your skin type, hair colour, and the treatment area. Our therapists will provide a personalised estimate after your initial consultation.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#hair3">
                                        Which body areas can be treated?
                                    </button>
                                </h2>
                                <div id="hair3" class="accordion-collapse collapse" data-bs-parent="#accordionHair">
                                    <div class="accordion-body faq-body">
                                        <p>We offer hair removal for most areas including arms, legs, underarms, and bikini line. Please contact us to confirm availability for specific areas.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ── SKIN GROWTH REMOVAL ── -->
            <div class="tab-pane fade" id="tab-skin" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="faq-tab-intro mb-4">
                            <img src="https://images.unsplash.com/photo-1741896136331-10375875eff4?w=900&h=280&fit=crop&q=80"
                                 alt="Skin Growth Removal"
                                 class="faq-tab-intro-img">
                        </div>

                        <div class="accordion faq-accordion" id="accordionSkin">

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#skin1"
                                            aria-expanded="true">
                                        Is mole and wart removal safe?
                                    </button>
                                </h2>
                                <div id="skin1" class="accordion-collapse collapse show" data-bs-parent="#accordionSkin">
                                    <div class="accordion-body faq-body">
                                        <p>Yes. Our natural herbal treatment is <strong>100% natural, painless, and non-surgical</strong>. We have completed over 6,000 successful treatments with minimal scarring and no use of chemicals.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#skin2">
                                        How long does the removal treatment take?
                                    </button>
                                </h2>
                                <div id="skin2" class="accordion-collapse collapse" data-bs-parent="#accordionSkin">
                                    <div class="accordion-body faq-body">
                                        <p>Individual treatment sessions are quick. Healing time depends on the size and type of skin growth, but most clients see visible results within a few days.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#skin3">
                                        What types of skin growths can be treated?
                                    </button>
                                </h2>
                                <div id="skin3" class="accordion-collapse collapse" data-bs-parent="#accordionSkin">
                                    <div class="accordion-body faq-body">
                                        <p>We treat <strong>moles, warts, skin tags, and fat deposits</strong> using our proprietary natural herbal preparation. Our method is equally effective — if not more so — than typical procedures such as electrosurgery or laser surgery.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button faq-btn collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#skin4">
                                        Will there be scarring after the treatment?
                                    </button>
                                </h2>
                                <div id="skin4" class="accordion-collapse collapse" data-bs-parent="#accordionSkin">
                                    <div class="accordion-body faq-body">
                                        <p>Our herbal method is designed to minimise scar formation. Because it is non-surgical, patient discomfort and scarring risk are significantly lower than conventional methods.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STILL HAVE QUESTIONS? -->
<section class="py-5">
    <div class="container">
        <div class="consultation-banner text-center">
            <span class="badge-beauty-light mb-3 d-inline-block">Still Unsure?</span>
            <h2 class="mb-3">We're Here to Help</h2>
            <p class="mb-4 opacity-75">
                Can't find the answer you're looking for? Call us or drop by for a free skin consultation.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="tel:+6563339093"
                   class="btn btn-light px-4 py-3 rounded-pill"
                   style="color:var(--primary);">
                    📞 +65 6333 9093
                </a>
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>"
                   class="btn btn-outline-light px-4 py-3 rounded-pill">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
