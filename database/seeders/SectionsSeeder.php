<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SectionsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $sections = [
            [
                'code' => 'hero',
                'name' => 'Sección Hero',
                'is_global' => false,
                'content' => null,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'contact_form',
                'name' => 'Formulario de contacto',
                'is_global' => false,
                'content' => null,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'services_cards',
                'name' => 'Tarjetas de servicios',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "imagen" => "/images/servicios-header.jpg",
                        "titulo" => "Our Services",
                        "tarjetas" => [
                            ["icono" => "fas fa-cog", "titulo" => "Configuration", "descripcion" => "Custom systems and services configuration."],
                            ["icono" => "fas fa-chart-line", "titulo" => "Analysis", "descripcion" => "Studies and analysis to optimize your processes."],
                            ["icono" => "fas fa-shield-alt", "titulo" => "Security", "descripcion" => "Complete protection of your data and services."],
                        ],
                        "subtitulo" => "What we offer to our clients",
                    ],
                    "es" => [
                        "imagen" => "/images/servicios-header.jpg",
                        "titulo" => "Nuestros Servicios",
                        "tarjetas" => [
                            ["icono" => "fas fa-cog", "titulo" => "Configuración", "descripcion" => "Configuración de sistemas y servicios personalizados."],
                            ["icono" => "fas fa-chart-line", "titulo" => "Análisis", "descripcion" => "Estudios y análisis para optimizar tus procesos."],
                            ["icono" => "fas fa-shield-alt", "titulo" => "Seguridad", "descripcion" => "Protección completa de tus datos y servicios."],
                        ],
                        "subtitulo" => "Lo que ofrecemos a nuestros clientes",
                    ],
                    "fr" => [
                        "imagen" => "/images/servicios-header.jpg",
                        "titulo" => "Nos Services",
                        "tarjetas" => [
                            ["icono" => "fas fa-cog", "titulo" => "Configuration", "descripcion" => "Configuration des systèmes et services personnalisés."],
                            ["icono" => "fas fa-chart-line", "titulo" => "Analyse", "descripcion" => "Études et analyses pour optimiser vos processus."],
                            ["icono" => "fas fa-shield-alt", "titulo" => "Sécurité", "descripcion" => "Protection complète de vos données et services."],
                        ],
                        "subtitulo" => "Ce que nous offrons à nos clients",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'testimonials',
                'name' => 'Testimonios',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "titulo" => "Our Services",
                        "subtitulo" => "What our clients say",
                        "testimonials" => [
                            ["name" => "Michael Smith", "imgAvatar" => "https://randomuser.me/api/portraits/men/65.jpg", "descripcion" => "Excellent service and outstanding results. Their team set up our system quickly and professionally, exceeding our expectations."],
                            ["name" => "Emily Johnson", "imgAvatar" => "https://randomuser.me/api/portraits/women/72.jpg", "descripcion" => "The analysis they conducted completely optimized our processes. Always attentive and professional, I highly recommend them."],
                            ["name" => "David Brown", "imgAvatar" => "https://randomuser.me/api/portraits/men/43.jpg", "descripcion" => "We feel total peace of mind thanks to the security measures implemented. Our team fully trusts their solutions."],
                        ],
                    ],
                    "es" => [
                        "titulo" => "Nuestros Servicios",
                        "subtitulo" => "Lo que dicen nuestros clientes",
                        "testimonials" => [
                            ["name" => "Carlos Méndez", "imgAvatar" => "https://randomuser.me/api/portraits/men/65.jpg", "descripcion" => "Excelente atención y resultados impresionantes. Su equipo configuró nuestro sistema de manera rápida y profesional, superando nuestras expectativas."],
                            ["name" => "Lucía Fernández", "imgAvatar" => "https://randomuser.me/api/portraits/women/72.jpg", "descripcion" => "Los análisis realizados optimizaron completamente nuestros procesos. Siempre atentos y muy profesionales, los recomiendo totalmente."],
                            ["name" => "Javier Rodríguez", "imgAvatar" => "https://randomuser.me/api/portraits/men/43.jpg", "descripcion" => "Sentimos una tranquilidad total gracias a la seguridad que implementaron. Nuestro equipo confía plenamente en sus soluciones."],
                        ],
                    ],
                    "fr" => [
                        "titulo" => "Nos Services",
                        "subtitulo" => "Ce que disent nos clients",
                        "testimonials" => [
                            ["name" => "Jean Dupont", "imgAvatar" => "https://randomuser.me/api/portraits/men/65.jpg", "descripcion" => "Service excellent et résultats impressionnants. Leur équipe a configuré notre système rapidement et professionnellement, dépassant nos attentes."],
                            ["name" => "Sophie Martin", "imgAvatar" => "https://randomuser.me/api/portraits/women/72.jpg", "descripcion" => "Les analyses qu'ils ont réalisées ont complètement optimisé nos processus. Toujours attentifs et très professionnels, je les recommande vivement."],
                            ["name" => "Pierre Leroy", "imgAvatar" => "https://randomuser.me/api/portraits/men/43.jpg", "descripcion" => "Nous avons une tranquillité totale grâce aux mesures de sécurité mises en place. Notre équipe fait pleinement confiance à leurs solutions."],
                        ],
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'alliances',
                'name' => 'Alianzas',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "titulo" => "Our Alliances",
                        "alliances" => [
                            ["alt" => "Logo Configuration Corp", "url" => "https://www.configuration.com", "name" => "Configuration Corp", "title" => "Visit Configuration Corp", "active" => 1, "imgLogo" => "milogo1.png", "description" => "Leading company in system configuration solutions."],
                            ["alt" => "Logo Analyse Inc", "url" => "https://www.analyse.com", "name" => "Analyse Inc", "title" => "Visit Analyse Inc", "active" => 1, "imgLogo" => "milogo2.png", "description" => "Experts in data analysis and process optimization."],
                        ],
                        "subtitulo" => "Companies and partners who trust us",
                    ],
                    "es" => [
                        "titulo" => "Nuestras Alianzas",
                        "alliances" => [
                            ["alt" => "Logo Configuration Corp", "url" => "https://www.configuration.com", "name" => "Configuration Corp", "title" => "Visitar Configuration Corp", "active" => 1, "imgLogo" => "milogo1.png", "description" => "Empresa líder en soluciones de configuración de sistemas."],
                            ["alt" => "Logo Analyse Inc", "url" => "https://www.analyse.com", "name" => "Analyse Inc", "title" => "Visitar Analyse Inc", "active" => 1, "imgLogo" => "milogo2.png", "description" => "Expertos en análisis de datos y optimización de procesos."],
                        ],
                        "subtitulo" => "Empresas y partners que confían en nosotros",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'news_letter',
                'name' => 'News Letter',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "title" => "Join our newsletter",
                        "btnTittle" => "Subscribe",
                        "description" => "Stay informed about the fastest-growing real estate investments and increasing property value.",
                        "nameExample" => "Your name",
                        "emailExample" => "Your email address",
                    ],
                    "es" => [
                        "title" => "Únete a nuestro newsletter",
                        "btnTittle" => "Suscribirme",
                        "description" => "Entérate de las inversiones inmobiliarias de mayor crecimiento y plusvalía.",
                        "nameExample" => "Tu nombre",
                        "emailExample" => "Tu correo electrónico",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'terms_and_conditions',
                'name' => 'Términos y Condiciones',
                'is_global' => true,
                'content' => json_encode([
                    "en" => "<h1>Terms and Conditions of Use</h1><p><strong>Last updated:</strong> October 21, 2025</p>...<p>📧 <a href='mailto:email@example.com'>email@example.com</a><br>📞 [contact number]</p>",
                    "es" => "<h1>Términos y Condiciones de Uso</h1><p><strong>Última actualización:</strong> 21 de octubre de 2025</p>...<p>📧 <a href='mailto:correo@ejemplo.com'>correo@ejemplo.com</a><br>📞 [número de contacto]</p>",
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'hero_lotes',
                'name' => 'Hero de Lotes',
                'is_global' => true,
                'content' => '{"en":{"imagen":"/images/hero-lotes.jpg","badge":"Low Min","titulo":"New Lots in Mazatlán","descripcion":"Explore our lots with an excellent selection and long-term appreciation potential, perfect for investing with confidence and security.","boton_principal":"Explore Available Lots","boton_secundario":"More Information","tarjetas":[{"icono":"fas fa-check-circle","titulo":"Guaranteed Capital Gain"},{"icono":"fas fa-shield-alt","titulo":"Secure Investment"},{"icono":"fas fa-map-marked-alt","titulo":"Strategic Location"},{"icono":"fas fa-bolt","titulo":"Fast Appreciation"}],"stats":[{"valor":"50+","texto":"Available Lots"},{"valor":"15%","texto":"Annual Appreciation"},{"valor":"24h","texto":"Quotation"}]},"es":{"imagen":"/images/hero-lotes.jpg","badge":"Low Min","titulo":"Lotes nuevos en Mazatlán","descripcion":"Explore nuestros lotes con excelente selección y proyección de plusvalía, perfectos para invertir con seguridad y confianza.","boton_principal":"Explorar Lotes Disponibles","boton_secundario":"Más Información","tarjetas":[{"icono":"fas fa-check-circle","titulo":"Plusvalía Garantizada"},{"icono":"fas fa-shield-alt","titulo":"Inversión Segura"},{"icono":"fas fa-map-marked-alt","titulo":"Ubicación Estratégica"},{"icono":"fas fa-bolt","titulo":"Rápida Valorización"}],"stats":[{"valor":"50+","texto":"Lotes Disponibles"},{"valor":"15%","texto":"Plusvalía Anual"},{"valor":"24h","texto":"Cotización"}]}}',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'venta_inmueble',
                'name' => 'Quiero vender',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "texto" => "If you want to sell your luxury property in the Riviera Maya at the best price and without complications, leave it in our hands and we will take care of the entire sales process.\n\nThis way you can sell your property without worrying about finding buyers or negotiating competitive prices.",
                        "imagen" => "https://img.freepik.com/foto-gratis/hombre-atractivo-serio-glassess-esta-pie-cerca-lugar-trabajo-oficina-viste-camisa-azul-chaqueta-oscura-esta-escribiendo-computadora-portatil_197531-522.jpg",
                        "titulo" => "Do you want to sell your property?",
                        "boton_url" => "#form",
                        "subtitulo" => "We take care of everything and sell your luxury property",
                        "boton_texto" => "SELL YOUR PROPERTY",
                    ],
                    "es" => [
                        "texto" => "Si quieres vender tu propiedad de lujo en la Riviera Maya al mejor precio y sin complicarte, déjalo en nuestras manos y nos encargamos de todo el proceso de venta.\n\nAsí podrás vender tu inmueble sin preocuparte por buscar compradores o por negociar precios competitivos.",
                        "imagen" => "https://img.freepik.com/foto-gratis/hombre-atractivo-serio-glassess-esta-pie-cerca-lugar-trabajo-oficina-viste-camisa-azul-chaqueta-oscura-esta-escribiendo-computadora-portatil_197531-522.jpg",
                        "titulo" => "¿Quieres vender tu inmueble?",
                        "boton_url" => "#formulario",
                        "subtitulo" => "Nos encargamos de todo y vendemos tu inmueble de lujo",
                        "boton_texto" => "VENDE TU INMUEBLE",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'porque_venta_inmueble',
                'name' => 'Por que Vender tu inmueble',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "titulo" => "WHY SELL YOUR PROPERTY WITH US",
                        "col1_icono" => "fa-search",
                        "col1_texto" => "Finding a buyer for your luxury property is not a problem when you have our team on your side.",
                        "col2_icono" => "fa-box-open",
                        "col2_texto" => "Hundreds of potential clients come to Jaguar Tulum every month. When you sell your property with us, we make sure they discover it.",
                        "col3_icono" => "fa-users",
                        "col3_texto" => "We know how to negotiate the sale so you get the best possible price for your luxury property.",
                        "col1_titulo" => "You won’t have to worry about finding a buyer",
                        "col2_titulo" => "Your property will appear in front of hundreds of potential clients",
                        "col3_titulo" => "We negotiate for you so you get the best price",
                    ],
                    "es" => [
                        "titulo" => "POR QUE VENDER TU PROPIEDAD CON NOSOTROS",
                        "col1_icono" => "fa-search",
                        "col1_texto" => "Encontrar un comprador para tu propiedad de lujo no es un problema cuando cuentas con nuestro equipo.",
                        "col2_icono" => "fa-box-open",
                        "col2_texto" => "Cientos de clientes potenciales llegan a Jaguar Tulum cada mes, cuando vendes tu propiedad con nosotros, nos aseguramos de que la descubran.",
                        "col3_icono" => "fa-users",
                        "col3_texto" => "Sabemos cómo negociar la venta para que consigas el mejor precio posible por tu propiedad de lujo.",
                        "col1_titulo" => "No tendrás que preocuparte por encontrar un comprador",
                        "col2_titulo" => "Tu propiedad aparecerá frente a cientos de clientes potenciales",
                        "col3_titulo" => "Negociamos por ti para que consigas el mejor precio",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'proceso_venta',
                'name' => 'Proceso de venta',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "titulo" => "Our Process",
                        "subtitulo" => "This is how we work with you step by step",

                        "col1_imagen" => "https://ejemplo.com/imagen1.jpg",
                        "col1_numero" => "1",
                        "col1_titulo" => "Initial Analysis",

                        "col2_imagen" => "https://ejemplo.com/imagen2.jpg",
                        "col2_numero" => "2",
                        "col2_titulo" => "Strategy Design",

                        "col3_imagen" => "https://ejemplo.com/imagen3.jpg",
                        "col3_numero" => "3",
                        "col3_titulo" => "Implementation",
                    ],
                    "es" => [
                        "titulo" => "Nuestro Proceso",
                        "subtitulo" => "Así es como trabajamos contigo paso a paso",

                        "col1_imagen" => "https://ejemplo.com/imagen1.jpg",
                        "col1_numero" => "1",
                        "col1_titulo" => "Análisis Inicial",

                        "col2_imagen" => "https://ejemplo.com/imagen2.jpg",
                        "col2_numero" => "2",
                        "col2_titulo" => "Diseño de Estrategia",

                        "col3_imagen" => "https://ejemplo.com/imagen3.jpg",
                        "col3_numero" => "3",
                        "col3_titulo" => "Implementación",
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'about-me',
                'name' => 'Acerca de Mí',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "image" => "https://mysite.com/me.jpg",
                        "title" => "About Me",
                        "content" => "<section><h2 class='text-2xl font-bold mb-4'>Who I Am</h2><p class='mb-8'>I am a professional with experience in development, technology and digital business. I am passionate about creating high-impact solutions.</p><div class='grid grid-cols-1 md:grid-cols-2 gap-6 mb-8'><div><h3 class='text-xl font-semibold mb-2'>Mission</h3><p>My mission is to deliver technological tools that improve processes, automate work and boost growth.</p></div><div><h3 class='text-xl font-semibold mb-2'>Vision</h3><p>My vision is to become a technological reference by creating solutions that combine innovation with simplicity.</p></div></div><h3 class='text-xl font-semibold mb-2'>Values</h3><ul class='list-disc pl-6 space-y-1'><li>Commitment</li><li>Honesty</li><li>Respect</li><li>Innovation</li><li>Collaboration</li></ul></section>"
                    ],
                    "es" => [
                        "image" => "https://misitio.com/mi-foto.jpg",
                        "title" => "Acerca de Mí",
                        "content" => "<section><h2 class='text-2xl font-bold mb-4'>Quién soy</h2><p class='mb-8'>Soy un profesional con experiencia en desarrollo, tecnología y negocios digitales. Me apasiona crear soluciones de alto impacto para empresas y personas.</p><div class='grid grid-cols-1 md:grid-cols-2 gap-6 mb-8'><div><h3 class='text-xl font-semibold mb-2'>Misión</h3><p>Mi misión es ofrecer herramientas tecnológicas que permitan mejorar procesos, automatizar tareas y potenciar el crecimiento de mis clientes.</p></div><div><h3 class='text-xl font-semibold mb-2'>Visión</h3><p>Mi visión es convertirme en un referente tecnológico creando soluciones que combinen innovación, simplicidad y resultados.</p></div></div><h3 class='text-xl font-semibold mb-2'>Valores</h3><ul class='list-disc pl-6 space-y-1'><li>Compromiso</li><li>Honestidad</li><li>Respeto</li><li>Innovación</li><li>Colaboración</li></ul></section>"
                    ]
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'hero_3',
                'name' => 'Hero 3',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "image" => "/uploads/hero3.jpg",
                        "title" => "<span style=\"color:#777\">Hello, I’m </span><span style=\"color:#0AB3B6;font-weight:700\">Rachel Zamudio</span>",
                        "button_link" => "/about-me",
                        "button_text" => "Read more about me",
                        "description" => "I am a content creator, designer, and passionate about connecting with people through visual and narrative experiences."
                    ],
                    "es" => [
                        "image" => "/uploads/hero3.jpg",
                        "title" => "<span style=\"color:#777\">Hola, soy </span><span style=\"color:#0AB3B6;font-weight:700\">Rachel Zamudio</span>",
                        "button_link" => "/sobre-mi",
                        "button_text" => "Mostrar más sobre mí",
                        "description" => "Soy creadora de contenido, diseñadora y apasionada por conectar con las personas mediante experiencias visuales y narrativas envolventes."
                    ],
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'aviso_privacidad',
                'name' => 'Aviso de Privacidad',
                'is_global' => true,
                'content' => json_encode([
                    "en" => [
                        "html" => "<h1 style=\"font-family:Rubik, sans-serif; font-size:42px; font-weight:800; color:#0A3333; text-align:center; margin-bottom:40px;\">Privacy Notice</h1><p style=\"font-size:18px; line-height:1.7; margin-bottom:20px;\">At <strong>Real Estate [Company Name]</strong> we value and respect the privacy of our clients. In compliance with the Federal Law on the Protection of Personal Data Held by Private Parties, we inform you that any personal information collected will be treated responsibly and confidentially, exclusively for purposes related to the provision of real estate services.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Personal Data Collected</h2><p style=\"font-size:18px; line-height:1.7;\">We may collect information such as:</p><ul style=\"font-size:18px; line-height:1.7; margin-left:20px;\"><li>Full name</li><li>Email address</li><li>Phone number</li><li>Identification details</li><li>Address and data required for real estate procedures</li><li>Payment information (when applicable)</li></ul><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Use of Information</h2><p style=\"font-size:18px; line-height:1.7;\">Your information may be used to:</p><ul style=\"font-size:18px; line-height:1.7; margin-left:20px;\"><li>Provide real estate advisory services</li><li>Prepare contracts, proposals, and legal documentation</li><li>Follow up on inquiries or procedures</li><li>Administrative and billing processes</li></ul><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Data Sharing</h2><p style=\"font-size:18px; line-height:1.7;\">Your information may be shared only with notaries, financial institutions, government authorities, or other parties required to fulfil legal or contractual obligations. <strong>We do not sell or trade personal information.</strong></p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">ARCO Rights</h2><p style=\"font-size:18px; line-height:1.7;\">You may access, rectify, cancel, or oppose the processing of your personal data by sending a request to: <strong>privacy@yourwebsite.com</strong>.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Information Security</h2><p style=\"font-size:18px; line-height:1.7;\">We implement technical and administrative security measures to prevent unauthorized access, loss, or improper disclosure of your data.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Updates</h2><p style=\"font-size:18px; line-height:1.7;\">This notice may be updated to comply with new legal requirements or internal policies. The latest version will always be available on our website.</p><p style=\"font-size:18px; line-height:1.7; margin-top:25px; color:#666;\">Last Updated: January 2025.</p>"
                    ],
                    "es" => [
                        "html" => "<h1 style=\"font-family:Rubik, sans-serif; font-size:42px; font-weight:800; color:#0A3333; text-align:center; margin-bottom:40px;\">Aviso de Privacidad</h1><p style=\"font-size:18px; line-height:1.7; margin-bottom:20px;\">En <strong>Inmobiliaria [Nombre de la Empresa]</strong> valoramos y respetamos la privacidad de nuestros clientes. En cumplimiento con la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, informamos que los datos personales que recopilamos serán tratados de manera responsable, confidencial y únicamente para fines relacionados con la prestación de servicios inmobiliarios.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Datos personales que recopilamos</h2><p style=\"font-size:18px; line-height:1.7;\">Podemos solicitar información como:</p><ul style=\"font-size:18px; line-height:1.7; margin-left:20px;\"><li>Nombre completo</li><li>Correo electrónico</li><li>Teléfono de contacto</li><li>Información de identificación</li><li>Dirección y datos necesarios para trámites inmobiliarios</li><li>Información de pago (cuando aplique)</li></ul><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Finalidades del tratamiento</h2><p style=\"font-size:18px; line-height:1.7;\">Su información será utilizada para ofrecer servicios como:</p><ul style=\"font-size:18px; line-height:1.7; margin-left:20px;\"><li>Asesoría personalizada en compra, venta o renta de propiedades</li><li>Generación de contratos, propuestas y documentación legal</li><li>Seguimiento de solicitudes o trámites</li><li>Procesos administrativos y facturación</li></ul><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Transferencia de datos</h2><p style=\"font-size:18px; line-height:1.7;\">Sus datos podrán compartirse únicamente con notarios, instituciones financieras, autoridades gubernamentales o proveedores necesarios para cumplir obligaciones legales o contractuales. <strong>No comercializamos ni vendemos información personal.</strong></p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Derechos ARCO</h2><p style=\"font-size:18px; line-height:1.7;\">Usted tiene derecho de acceder, rectificar, cancelar u oponerse al uso de sus datos personales. Para ejercerlos, puede enviar una solicitud al correo: <strong>privacidad@tusitio.com</strong>.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Medidas de seguridad</h2><p style=\"font-size:18px; line-height:1.7;\">Implementamos medidas técnicas y administrativas que protegen su información contra acceso no autorizado, pérdida o alteración.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">Modificaciones al aviso</h2><p style=\"font-size:18px; line-height:1.7;\">Este aviso podrá actualizarse debido a cambios legislativos o ajustes internos. La versión vigente estará disponible en nuestro sitio web.</p><p style=\"font-size:18px; line-height:1.7; margin-top:25px; color:#666;\">Última actualización: Enero 2025.</p>"
                    ]
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
            'code' => 'terminos',
            'name' => 'Términos y Condiciones',
            'is_global' => true,
            'content' => json_encode([
                "en" => [
                    "html" => "<h1 style=\"font-family:Rubik, sans-serif; font-size:42px; font-weight:800; color:#0A3333; text-align:center; margin-bottom:40px;\">Terms and Conditions</h1><p style=\"font-size:18px; line-height:1.7; margin-bottom:20px;\">Welcome to <strong>Real Estate [Company Name]</strong>. By accessing or using our website, services, or digital platforms, you agree to the terms and conditions described below. Please read this document carefully as it governs the rights and obligations between you and our company.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">1. Use of the Website</h2><p style=\"font-size:18px; line-height:1.7;\">The information provided on this website is for informational and commercial purposes related to real estate services. You agree not to misuse the content, perform actions that may affect its functionality, or attempt unauthorized access to private areas.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">2. Accuracy of Information</h2><p style=\"font-size:18px; line-height:1.7;\">We strive to keep property listings, prices, availability, and descriptions as accurate as possible; however, all information is subject to change without prior notice and is not guaranteed. Property availability may vary at any time.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">3. Intellectual Property</h2><p style=\"font-size:18px; line-height:1.7;\">All images, text, logos, videos, and materials displayed on this website are the exclusive property of <strong>[Company Name]</strong> or third parties who have granted usage rights. Their reproduction or distribution without written authorization is strictly prohibited.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">4. Emails, Forms, and Contact</h2><p style=\"font-size:18px; line-height:1.7;\">By filling out forms or contacting us through any channel, you acknowledge that the information provided is truthful and voluntary. The use and protection of this data are governed by our Privacy Notice.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">5. Limitation of Liability</h2><p style=\"font-size:18px; line-height:1.7;\">We are not responsible for damages that may arise from the use or inability to use our website, including interruptions, errors, viruses, or incorrect information. Users must independently verify property details and conditions.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">6. External Links</h2><p style=\"font-size:18px; line-height:1.7;\">Our website may contain links to external pages. We are not responsible for their content, policies, or security practices. Access to these sites is at the user’s own risk.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">7. Changes to These Terms</h2><p style=\"font-size:18px; line-height:1.7;\">We may update these Terms and Conditions at any time due to legal, operational, or business-related changes. The most recent version will always be available on this website.</p><p style=\"font-size:18px; line-height:1.7; margin-top:25px; color:#666;\">Last Updated: January 2025.</p>"
                ],
                "es" => [
                    "html" => "<h1 style=\"font-family:Rubik, sans-serif; font-size:42px; font-weight:800; color:#0A3333; text-align:center; margin-bottom:40px;\">Términos y Condiciones</h1><p style=\"font-size:18px; line-height:1.7; margin-bottom:20px;\">Bienvenido a <strong>Inmobiliaria [Nombre de la Empresa]</strong>. Al acceder o utilizar nuestro sitio web, servicios o plataformas digitales, usted acepta los términos y condiciones que se describen a continuación. Le recomendamos leer este documento cuidadosamente, ya que regula los derechos y obligaciones entre usted y nuestra empresa.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">1. Uso del sitio web</h2><p style=\"font-size:18px; line-height:1.7;\">La información presentada en este sitio tiene fines informativos y comerciales relacionados con servicios inmobiliarios. Usted se compromete a no hacer uso indebido del contenido, realizar acciones que afecten su funcionamiento o intentar acceder a áreas privadas sin autorización.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">2. Exactitud de la información</h2><p style=\"font-size:18px; line-height:1.7;\">Nos esforzamos por mantener la información de propiedades, precios, disponibilidad y descripciones lo más precisa posible; sin embargo, todo está sujeto a cambios sin previo aviso y no se garantiza la disponibilidad. La disponibilidad de propiedades puede variar en cualquier momento.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">3. Propiedad intelectual</h2><p style=\"font-size:18px; line-height:1.7;\">Todo el material mostrado, incluyendo imágenes, textos, logotipos, videos y contenido multimedia, es propiedad exclusiva de <strong>[Nombre de la Empresa]</strong> o de terceros con derechos otorgados. Queda estrictamente prohibida su reproducción o distribución sin autorización escrita.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">4. Formularios, correos y contacto</h2><p style=\"font-size:18px; line-height:1.7;\">Al completar formularios o ponerse en contacto con nosotros mediante cualquier medio, usted declara que la información proporcionada es veraz y voluntaria. El uso y protección de estos datos se rige por nuestro Aviso de Privacidad.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">5. Limitación de responsabilidad</h2><p style=\"font-size:18px; line-height:1.7;\">No somos responsables por daños derivados del uso o la imposibilidad de uso del sitio web, incluyendo interrupciones, errores, virus o información incorrecta. El usuario debe verificar de manera independiente las condiciones y características de cada propiedad.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">6. Enlaces externos</h2><p style=\"font-size:18px; line-height:1.7;\">Nuestro sitio puede contener enlaces a sitios externos. No somos responsables de su contenido, políticas o prácticas. El acceso a ellos es bajo su propio riesgo.</p><h2 style=\"font-size:26px; font-weight:700; color:#0AB3B6; margin-top:35px;\">7. Modificaciones a estos términos</h2><p style=\"font-size:18px; line-height:1.7;\">Estos Términos y Condiciones pueden actualizarse en cualquier momento por cambios legales, operativos o internos. La versión más reciente siempre estará disponible en este sitio web.</p><p style=\"font-size:18px; line-height:1.7; margin-top:25px; color:#666;\">Última actualización: Enero 2025.</p>"
                ]
            ]),
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]






        ];

        DB::table('sections')->insert($sections);
    }
}
