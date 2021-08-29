<?= $this->extend('Frontend/layouts/homeLayout'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row sticky-wrapper">
        <!-- Sidebar ================================================== -->
        <div class="col-lg-4 col-md-4" style="top: 100px;">
            <div class="user-profile-titlebar mb-5">
                <div class="user-profile-avatar">
                    <?php if ($user['photoURL']) : ?>
                        <img src="<?= $user['photoURL'] ?>" alt="<?= $user['firstName'] . ' ' . $user['lastname'] ?>" />
                    <?php else : ?>
                        <img src="/public/assets/images/user-profile-avatar.jpg" alt="<?= $user['firstName'] . ' ' . $user['lastname'] ?>" />
                    <?php endif; ?>

                </div>
                <div class="user-profile-name">
                    <h2 class="mt-0 mb-0">
                        <?= $user['firstName'] ?>
                    </h2>
                    <span><a href="">Edit Profile</a></span>
                </div>
                <p></p>
            </div>

            <div class="boxed-widget margin-top-30 margin-bottom-50 customwidget">
                <p class="mb-3">
                    <small>
                        <div style="text-align:left;">
                            <?= $user['aboutuser'] ?>
                        </div>
                    </small>
                </p>
                <ul class="listing-details-sidebar mb-3">
                    <li>
                        <?php if ($user['city'] || $user['country']) : ?>
                            <i class="fa fa-home" style="color: green;"></i> <?= $user['city'] ?> <?= $user['country'] ?>
                        <?php else : ?>
                            <i class="fa fa-home" style="color: crimson;"></i> Location not set
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($user['languages']) : ?>
                            <i class="fa fa-language" style="color: green;"></i> <?= $user['languages'] ?>
                        <?php else : ?>
                            <i class="fa fa-language" style="color: crimson;"></i> languages not set
                        <?php endif; ?>
                    </li>
                    <li>
                        <i class="sl sl-icon-speech" style="color: green;"></i> 0 reviews
                    </li>
                    <li>
                        <?php if ($user['city'] || $user['country']) : ?>
                            <i class="sl sl-icon-user-following" style="color: green;"></i> Identity not verified
                        <?php else : ?>
                            <i class="sl sl-icon-user-following" style="color: crimson;"></i> Identity Verified
                        <?php endif; ?>
                    </li>
                </ul>
                <div class="dropdown-divider mb-5"></div>
                <ul class="listing-details-sidebar mt-3">
                    <li>
                        <?php if ($user['emailVerified']) : ?>
                            <i class="sl sl-icon-check" style="color: green;"></i> Email address
                        <?php else : ?>
                            <i class="sl sl-icon-close" style="color: red;"></i> Email address
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($user['phoneVerified']) : ?>
                            <i class="sl sl-icon-check" style="color: green;"></i> Phone number
                        <?php else : ?>
                            <i class="sl sl-icon-close" style="color: red;"></i> Phone number
                        <?php endif; ?>
                    </li>
                </ul>
                <p class="mt-5">
                    Learn more about how confirming account info helps keep us community secure.
                </p>
            </div>
        </div>
        <!-- Sidebar / End -->

        <!-- Content ================================================== -->
        <div class="col-lg-8 col-md-8 padding-left-30">
            <!-- MEDICAL DATA -->
            <div class="row mb-5">
                <div class="col-12 ml-4 mb-4" style="min-height: 50px;">
                    <h3 class="float-left" style="display: block;">Medical Data</h3>
                    <button class="button float-right" style="display: block;" (click)="updateMedicalRecords()">
                        Add/Edit Medical Data <i class="fa fa-angle-right"></i>
                    </button>
                </div>
                <hr>
                <div id="medicalDetailsBlock" *ngIf="userMedicalData !== null">
                    <div class="col-12 col-md-12" *ngIf="userMedicalData.flu_symptoms.flu_others || userMedicalData.flu_symptoms.cough || userMedicalData.flu_symptoms.fever || userMedicalData.flu_symptoms.runny_nose || userMedicalData.flu_symptoms.shortness_of_breath || userMedicalData.flu_symptoms.sore_throat">
                        <h5>Do you have any of the following flu like symtoms:</h5>
                        <ul class="listing-features checkboxes margin-top-0">
                            <?php if ($medical['flu_fever']) : ?>
                                <li>Fever</li>
                            <?php endif; ?>
                            <?php if ($medical['flu_cough']) : ?>
                                <li>Cough</li>
                            <?php endif; ?>
                            <?php if ($medical['flu_sore_throat']) : ?>
                                <li>Sore Throat</li>
                            <?php endif; ?>
                            <?php if ($medical['flu_runny_nose']) : ?>
                                <li>Runny Nose</li>
                            <?php endif; ?>
                            <?php if ($medical['flu_shortness_of_breath']) : ?>
                                <li>Shortness of Breath</li>
                            <?php endif; ?>
                            <?php if ($medical['flu_others']) : ?>
                                <br>
                                <li>Others:- <?= $medical['flu_others'] ?></li>
                            <?php endif; ?>
                            <?php if (!$medical['flu_fever'] && $medical['flu_cough'] && $medical['flu_sore_throat'] && $medical['flu_runny_nose'] && $medical['flu_shortness_of_breath'] && $medical['flu_others']) : ?>
                                <li>NO</li>
                            <?php endif; ?>
                        </ul>
                        <hr>
                    </div>
                    <div class="col-12 col-md-12">
                        <h5>Do you have a chronic medical condition such as diabetes, hypertension, cancer, immune
                            compromising disorder?</h5>
                        <?php if ($medical['chronic_specify']) : ?>
                            <p><?= $medical['chronic_specify'] ?></p>
                        <?php else : ?>
                            <p>NO</p>
                        <?php endif; ?>
                        <hr>
                    </div>
                    <div class="col-12 col-md-12">
                        <h5>Are you currently on any medication?</h5>
                        <?php if ($medical['medication_specify']) : ?>
                            <p><?= $medical['medication_specify'] ?></p>
                        <?php else : ?>
                            <p>NO</p>
                        <?php endif; ?>
                        <hr>
                    </div>
                    <div class="col-12 col-md-12">
                        <h5>Do you have anyone living with you who is above 60 years of age?</h5>
                        <?php if ($medical['above_60_specify']) : ?>
                            <p><?= $medical['above_60_specify'] ?></p>
                        <?php else : ?>
                            <p>NO</p>
                        <?php endif; ?>
                        <hr>
                    </div>
                    <div class="col-12 col-md-12">
                        <h5>Do you have anyone living with you who is suffering from low immunity or chronic disease
                            (diabetes, hypertension, cacer, etc.)</h5>
                        <?php if ($medical['living_with_specify']) : ?>
                            <p><?= $medical['living_with_specify'] ?></p>
                        <?php else : ?>
                            <p>NO</p>
                        <?php endif; ?>
                        <hr>
                    </div>
                    <div class="col-12 col-md-12">
                        <h5>Do you have health insurance?</h5>
                        <?php if ($medical['insurance_data']) : ?>
                            <p><?= $medical['insurance_data'] ?></p>
                        <?php else : ?>
                            <p>NO</p>
                        <?php endif; ?>
                    </div>

                </div>

                <form class="mt-5" [formGroup]="medicalForm" id="medicalDetailsForm" (ngSubmit)="saveMedicalForm()" hidden>
                    <div class="col-12" formGroupName="flu_symptoms">
                        <h4>Do you have any of the following flu like symtoms:</h4>
                        <ul class="checkboxes margin-top-0 d-flex">
                            <li>
                                <input id="fever" type="checkbox" formControlName="fever" [checked]="fever">
                                <label for="fever">Fever</label>
                            </li>
                            <li>
                                <input id="cough" type="checkbox" formControlName="cough" [checked]="cough">
                                <label for="cough">Cough</label>
                            </li>
                            <li>
                                <input id="sore_throat" type="checkbox" formControlName="sore_throat" [checked]="sore_throat">
                                <label for="sore_throat">Sore Throat</label>
                            </li>
                            <li>
                                <input id="runny_nose" type="checkbox" formControlName="runny_nose" [checked]="runny_nose">
                                <label for="runny_nose">Runny Nose</label>
                            </li>
                            <li>
                                <input id="shortness_of_breath" type="checkbox" formControlName="shortness_of_breath" [checked]="shortness_of_breath">
                                <label for="shortness_of_breath">Shortness of Breath</label>
                            </li>
                        </ul>
                        <div>
                            <label>Others, please specify:</label>
                            <input formControlName="flu_others" type="text" [value]="flu_others">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" formGroupName="chronic_medical_condition">
                        <h4>Do you have a chronic medical condition such as diabetes, hypertension, cancer, immune
                            compromising disorder?</h4>
                        <div class="d-flex" [ngClass]="{'invalid-formfield': chronic_check.invalid && (chronic_check.dirty || chronic_check.touched)}">
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="true" formControlName="chronic" (change)="onChronicChange()"> Yes
                            </span>
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="false" formControlName="chronic" (change)="onChronicChange()"> No
                            </span>
                        </div>
                        <div id="chronic_specify" [hidden]="!chronic">
                            <label>specify:</label>
                            <input formControlName="chronic_specify" type="text" [value]="chronic_specify" [ngClass]="{'invalid-formfield': chronic_data_check.invalid && (chronic_data_check.dirty || chronic_data_check.touched)}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" formGroupName="on_medication">
                        <h4>Are you currently on any medication?</h4>
                        <div class="d-flex" [ngClass]="{'invalid-formfield': medication_check.invalid && (medication_check.dirty || medication_check.touched)}">
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="true" formControlName="medication" (change)="onMedicationChange()"> Yes
                            </span>
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="false" formControlName="medication" (change)="onMedicationChange()"> No
                            </span>
                        </div>
                        <div id="medication_specify" [hidden]="!medication">
                            <label>Please specify:</label>
                            <input formControlName="medication_specify" type="text" [value]="medication_specify" [ngClass]="{'invalid-formfield': medication_data_check.invalid && (medication_data_check.dirty || medication_data_check.touched)}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" formGroupName="above_60_years">
                        <h4>Do you have anyone living with you who is above 60 years of age?</h4>
                        <div class="d-flex" [ngClass]="{'invalid-formfield': above_60_check.invalid && (above_60_check.dirty || above_60_check.touched)}">
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="true" formControlName="above_60" (change)="on60yearsChange()"> Yes
                            </span>
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="false" formControlName="above_60" (change)="on60yearsChange()"> No
                            </span>
                        </div>
                        <div id="above_60_specify" [hidden]="!above_60">
                            <label>Please specify:</label>
                            <input formControlName="above_60_specify" type="text" [value]="above_60_specify" [ngClass]="{'invalid-formfield': above_60_data_check.invalid && (above_60_data_check.dirty || above_60_data_check.touched)}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" formGroupName="living_with_patient">
                        <h4>Do you have anyone living with you who is suffering from low immunity or chronic disease
                            (diabetes, hypertension, cacer, etc.)</h4>
                        <div class="d-flex" [ngClass]="{'invalid-formfield': living_check.invalid && (living_check.dirty || living_check.touched)}">
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="true" formControlName="living_with" (change)="onLivingwithChange()"> Yes
                            </span>
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="false" formControlName="living_with" (change)="onLivingwithChange()"> No
                            </span>
                        </div>
                        <div id="living_with_specify" [hidden]="!living_with">
                            <label>Please specify:</label>
                            <input formControlName="living_with_specify" type="text" [value]="living_with_specify" [ngClass]="{'invalid-formfield': living_data_check.invalid && (living_data_check.dirty || living_data_check.touched)}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-12" formGroupName="health_insurance">
                        <h4>Do you have health insurance?</h4>
                        <div class="d-flex" [ngClass]="{'invalid-formfield': insurance_check.invalid && (insurance_check.dirty || insurance_check.touched)}">
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="true" formControlName="insurance" (change)="onInsuranceChange()"> Yes
                            </span>
                            <span style="min-width:75px;" class="d-flex radioInput">
                                <input type="radio" [value]="false" formControlName="insurance" (change)="onInsuranceChange()"> No
                            </span>
                        </div>
                        <div id="insurance_data" [hidden]="!insurance">
                            <label>Please specify:</label>
                            <input formControlName="insurance_data" type="text" [value]="insurance_data" [ngClass]="{'invalid-formfield': insurance_data_check.invalid && (insurance_data_check.dirty || insurance_data_check.touched)}">
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button class="button float-right" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- Listings Container -->
            <!-- <div class="row">
				<div class="col ml-4">
					<h3 class="mt-0 mb-5">{{ nameUser+"'s" }} Listings</h3>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout">
						<a href="listings-single-page.html" class="listing-item">
							<div class="listing-item-image">
								<img src="assets/images/listing-item-01.jpg" alt="" />
								<span class="tag">Eat & Drink</span>
							</div>

							<div class="listing-item-content">
								<div class="listing-badge now-open">HardCode</div>

								<div class="listing-item-inner">
									<h3>Tom's Restaurant</h3>
									<span>964 School Street, New York</span>
									<div class="star-rating" data-rating="3.5">
										<div class="rating-counter">(12 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-12 browse-all-user-listings">
					<a href="#">Browse All Listings <i class="fa fa-angle-right"></i> </a>
				</div>
			</div> -->
            <!-- Listings Container / End -->

            <!-- <div class="dropdown-divider mt-5"></div> -->
            <!-- Reviews -->
            <div id="listing-reviews" class="listing-section">
                <h3 class="margin-top-60 margin-bottom-20">60 Reviews</h3>

                <div class="clearfix"></div>

                <!-- Reviews -->
                <section class="comments listing-reviews">
                    <ul>
                        <li>
                            <div class="avatar">
                                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" />
                            </div>
                            <div class="comment-content">
                                <div class="arrow-comment"></div>
                                <div class="comment-by">
                                    Kathy Brown
                                    <div class="comment-by-listing">
                                        on <a href="#">Burger House</a>
                                    </div>
                                    <span class="date">June 2019</span>
                                    <div class="star-rating" data-rating="5"></div>
                                </div>
                                <p>
                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                    Nam posuere tristique sem, eu ultricies tortor imperdiet
                                    vitae. Curabitur lacinia neque non metus
                                </p>
                            </div>
                        </li>
                    </ul>
                </section>

                <!-- Pagination -->
                <!-- <div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="pagination-container margin-top-30">
							<nav class="pagination">
								<ul>
									<li><a href="#" class="current-page">1</a></li>
									<li><a href="#">2</a></li>
									<li>
										<a href="#"><i class="sl sl-icon-arrow-right"></i></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="clearfix"></div> -->
            </div>

        </div>
    </div>
</div>



<style>
    .panel-dropdown .panel-dropdown-content {
        width: fit-content;
    }

    .panel-dropdown a {
        padding: 9px 14px;
        margin: auto;
        display: block;
        width: 100%;
        height: 44px;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months {
        font-size: 15px;
        width: auto;
        display: inline;
    }

    .panel-dropdown {
        position: relative;
        display: block;
    }

    .homepage_subheading span {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(0, 0, 0, 0.21);
        padding: 4px 12px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .main-search-input .fa {
        color: #123815 !important;
    }
</style>

<?= $this->endSection(); ?>