@extends('layouts.user_type.website')
@section('content')
<!-- content begin -->
<div class="no-bottom no-top" id="content">
   <div id="top"></div>
   <section class="pt10 pb10 mt80 bg-grey">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-12 text-center">
               <h3 class="mb-0">FAQ </h3>
            </div>
         </div>
      </div>
   </section>
   <section class="jarallax">
      <img src="images/background/gradient-2.webp" class="jarallax-img" alt="">
      <div class="container">
         <div class="row align-items-center g-4">
            <div class="col-lg-8">
               <div class="subtitle bg-white wow fadeInUp mb-3">Do you have</div>
               <h2 class="wow fadeInUp" data-wow-delay=".2s">Any questions?</h2>
            </div>
           {{--  <div class="col-lg-4 text-lg-end">
               <a class="btn-text text-dark wow fadeInLeft" href="#">More questions</a>
            </div> --}}
         </div>
         <div class="row g-custom-4">
            <div class="col-md-6 wow fadeInUp">
               <div class="accordion secondary">
                  <div class="accordion-section">
                     <div class="accordion-section-title" data-tab="#accordion-1">
                        General Questions
                     </div>
                     <div class="accordion-section-content" id="accordion-1">
                        <ul>
                           <li>
                              <h5>What is Energeios?</h5>
                              <p>
                                 Energeios is a global platform where individuals invest in EV charging stations and earn fixed passive income.
                              </p>
                           </li>
                           <li>
                              <h5>What is the minimum investment amount?</h5>
                              <p>The minimum investment is $50 USDT (BEP20).</p>
                           </li>
                           <li>
                              <h5>Can I make multiple investments?</h5>
                              <p>Yes, multiple top-ups are allowed.</p>
                           </li>
                           <li>
                              <h5>Is there any joining fee?</h5>
                              <p>No, there is no joining fee. You only need to invest in packages starting at $50.</p>
                           </li>
                           <li>
                              <h5>Why EV charging stations?</h5>
                              <p>EV charging is the future of energy. By investing in Energeios, you earn from the fastest-growing energy sector.</p>
                           </li>
                        </ul>
                     </div>
                     <div class="accordion-section-title" data-tab="#accordion-2">
                        Direct Income
                     </div>
                     <div class="accordion-section-content" id="accordion-2">
                        <ul>
                           <li>
                              <h5>What is Direct Income?</h5>
                              <p>You earn 10% instant income for every direct referral.</p>
                           </li>
                           <li>
                              <h5>Example of Direct Income?</h5>
                              <p>If your referral invests $50, you instantly earn $5.</p>
                           </li>
                           <li>
                              <h5>Is there a limit on Direct Income?</h5>
                              <p>No, there is no limit. You earn 10% on every referral.</p>
                           </li>
                           <li>
                              <h5>When is Direct Income credited?</h5>
                              <p>Direct Income is credited instantly after your referral invests.</p>
                           </li>
                           <li>
                              <h5>Do I need to qualify for Direct Income?</h5>
                              <p>No, Direct Income is available to all users without conditions.</p>
                           </li>
                        </ul>
                     </div>
                     <div class="accordion-section-title" data-tab="#accordion-3">
                        Ranks & Rank Income
                     </div>
                     <div class="accordion-section-content" id="accordion-3">
                        <ul>
                           <li>
                              <h5>What are ranks in Energeios?</h5>
                              <p>Ranks are achievement levels that increase your income potential.</p>
                           </li>
                           <li>
                              <h5>How many ranks are there?</h5>
                              <p>There are 12 ranks from Prime to Luminary.</p>
                           </li>
                           <li>
                              <h5>What is Rank Income?</h5>
                              <p>It is a weekly bonus paid for 100 weeks based on your achieved rank.</p>
                           </li>
                           <li>
                              <h5>When does Rank Income start after qualification?</h5>
                              <p>Your upgraded rank income begins immediately at the next closing after the current period.</p>
                           </li>
                           <li>
                              <h5>Examples of Rank Income?</h5>
                              <p>
                                 * Prime: $1 weekly → $100 total<br>
                                 * Pioneer: $12 weekly → $1,200 total<br>
                                 * Luminary: $2,500 weekly → $250,000 total<br>
                                 1. When is Rank Income generated? Rank Income is generated every Sunday at 11:45 PM (UK time).<br>
                                 2. When are Rank qualifications updated? Rank qualifications update daily at 11:30 PM (UK time).<br>
                                 3. Do I need to maintain my team to keep Rank Income? No, once achieved, you receive Rank Income for 100 weeks.<br>
                                 4. Can multiple ranks be earned? Yes, as your team grows, you can keep upgrading ranks.<br>
                                 5. Is there a cap on Rank Income?<br>
                                 No, Rank Income is fixed as per the rank table, paid weekly for 100 weeks.
                              </p>
                           </li>

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 wow fadeInUp">
               <div class="accordion secondary">
                  <div class="accordion-section">
                     <div class="accordion-section-title" data-tab="#accordion-b-4">
                        Investment & ROI
                     </div>
                     <div class="accordion-section-content" id="accordion-b-4">
                        <ul>
                           <li>
                              <h5>What is the daily ROI?</h5>
                              <p>You earn 1% daily ROI for 200 days.</p>
                           </li>
                           <li>
                              <h5>How much total ROI do I get?</h5>
                              <p>You get 200% total ROI. For example, $50 investment gives $100 return.</p>
                           </li>
                           <li>
                              <h5>Does ROI stop after 200%?</h5>
                              <p>Yes, each package ends once it reaches 200%.</p>
                           </li>
                           <li>
                              <h5>Are weekends and holidays included in ROI?</h5>
                              <p>Yes, ROI is calculated for all 200 days continuously.</p>
                           </li>
                           <li>
                              <h5>Can I reinvest my earnings?</h5>
                              <p>Yes, you can create a new top-up package anytime.</p>
                           </li>
                        </ul>
                     </div>
                     <div class="accordion-section-title" data-tab="#accordion-b-5">
                        Matching Income (Binary Income)
                     </div>
                     <div class="accordion-section-content" id="accordion-b-5">
                        <ul>
                           <li>
                              <h5>What is Matching Income?</h5>
                              <p>Matching Income is earned from your left and right team business volume.</p>
                           </li>
                           <li>
                              <h5>How to qualify for Matching Income?</h5>
                              <p>You need 2 active directs — one on each side.</p>
                           </li>
                           <li>
                              <h5>What is the percentage of Matching Income?</h5>
                              <p>It ranges from 7% to 15% depending on your rank.</p>
                           </li>
                           <li>
                              <h5>What is the daily capping for Matching Income?</h5>
                              <p>Capping starts at $500 and goes up to $5,000 per day based on rank.</p>
                           </li>
                           <li>
                              <h5>5. When does Matching Income close daily?</h5>
                              <p>Daily Matching Income closes at 11:59 PM (UK time).</p>
                           </li>
                           
                        </ul>
                     </div>
                     <div class="accordion-section-title" data-tab="#accordion-b-6">
                        Withdrawals
                     </div>
                     <div class="accordion-section-content" id="accordion-b-6">
                        <p>
                           * Currencies: USDT (BEP20)<br>
                           * Minimum Withdrawal: $5 (USDT)<br>
                           * Withdrawal Day: Requests on Sunday, processed within 30 minutes<br>
                           * Deduction: 10% withdrawal fee<br>
                           * Daily Matching Income Closing: 11:59 PM (UK time)<br>
                           * Rank Income Generation: Sundays, 11:45 PM (UK time)<br>
                           * Rank Qualification Updates: Daily at 11:30 PM (UK time)<br>
                           * Reach your rank? Upgraded income begins at the next closing after the current period.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- content close -->
@endsection
