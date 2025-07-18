<!-- FAQ Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __("Questions fréquentes") }}</h2>
                <p class="text-lg text-gray-600">{{ __("Trouvez rapidement les réponses à vos questions sur Hub Ivoire Tech") }}</p>
            </div>

            <!-- FAQ Accordion -->
            <div class="space-y-4" x-data="{ active: null }">
                <!-- Question 1 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 flex justify-between items-center"
                        @click="active = active === 1 ? null : 1"
                        :class="{ 'bg-gray-50': active === 1 }"
                    >
                        <span class="text-base font-semibold text-gray-900">{{ __("Qu'est-ce que Hub Ivoire Tech ?") }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180': active === 1 }"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-show="active === 1"
                        x-collapse
                        x-cloak
                        class="px-6 py-4 bg-white border-t border-gray-200"
                    >
                        <p class="text-gray-600">{{ __("Hub Ivoire Tech a pour vocation d'être le plus grand Campus de Startups en Afrique. Il réunit un écosystème d'incubateurs, d'accélérateurs, d'investisseurs, d'experts et d'entrepreneurs afin de stimuler l'innovation et de transformer les idées en succès concrets sur le territoire ivoirien et au-delà.") }}</p>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 flex justify-between items-center"
                        @click="active = active === 2 ? null : 2"
                        :class="{ 'bg-gray-50': active === 2 }"
                    >
                        <span class="text-base font-semibold text-gray-900">{{ __("Quels services proposez-vous ?") }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180': active === 2 }"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-show="active === 2"
                        x-collapse
                        x-cloak
                        class="px-6 py-4 bg-white border-t border-gray-200"
                    >
                        <p class="text-gray-600">{{ __("Nous offrons une gamme complète de services pour accompagner les entrepreneurs à chaque étape de leur développement : programmes d'incubation et d'accélération (avec coaching, mentoring et masterclasses), espaces de coworking modernes, salles de réunion équipées, espaces de détente, fablab pour l'innovation, ainsi qu'un support administratif pour faciliter vos démarches.") }}</p>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 flex justify-between items-center"
                        @click="active = active === 3 ? null : 3"
                        :class="{ 'bg-gray-50': active === 3 }"
                    >
                        <span class="text-base font-semibold text-gray-900">{{ __("Qui peut bénéficier de vos programmes d'accompagnement ?") }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180': active === 3 }"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-show="active === 3"
                        x-collapse
                        x-cloak
                        class="px-6 py-4 bg-white border-t border-gray-200"
                    >
                        <p class="text-gray-600">{{ __("Nos programmes s'adressent aux startups, porteurs de projets et entrepreneurs désireux de concrétiser leurs idées. Que vous soyez en phase de création ou en pleine croissance, Hub Ivoire Tech propose un accompagnement sur-mesure pour booster votre développement grâce à un réseau d'experts et de partenaires stratégiques.") }}</p>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 flex justify-between items-center"
                        @click="active = active === 4 ? null : 4"
                        :class="{ 'bg-gray-50': active === 4 }"
                    >
                        <span class="text-base font-semibold text-gray-900">{{ __("Comment rester informé·e des actualités et événements ?") }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180': active === 4 }"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-show="active === 4"
                        x-collapse
                        x-cloak
                        class="px-6 py-4 bg-white border-t border-gray-200"
                    >
                        <p class="text-gray-600">{{ __("Pour être tenu·e au courant de nos dernières actualités, formations, hackathons et autres événements, inscrivez-vous à notre newsletter et activez les notifications via WhatsApp. Vous recevrez directement dans votre boîte mail ou sur votre téléphone toutes les informations importantes et opportunités proposées par Hub Ivoire Tech.") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
