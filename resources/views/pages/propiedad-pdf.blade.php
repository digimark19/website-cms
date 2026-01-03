<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $propiedad->nombre[app()->getLocale()] ?? 'Ficha Técnica' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rubik', sans-serif; color: #1f2937; margin: 0; padding: 0; font-size: 14px; }
        
        /* Compact Header */
        .header { 
            padding: 30px 40px 15px 40px; 
            border-bottom: 2px solid #0AB3B6; 
            margin-bottom: 20px; 
            display: block; /* Ensure block formatting context */
        }
        .header-content {
            width: 100%;
        }
        .header h1 { 
            color: #052669; 
            font-size: 22px; 
            font-weight: 700; 
            margin: 0; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            text-align: left;
        }
        .header h2 { 
            color: #6b7280; 
            font-size: 12px; 
            margin: 5px 0 0 0; 
            font-weight: 400; 
            text-align: left;
        }
        
        .container { padding: 0 40px; }
        
        .price { 
            font-size: 26px; 
            color: #0AB3B6; 
            font-weight: bold; 
            margin: 20px 0 30px 0; 
            padding-bottom: 15px; 
            border-bottom: 1px solid #f3f4f6; 
        }
        
        .grid-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .grid-table td { padding: 8px 0; border-bottom: 1px solid #f3f4f6; width: 50%; vertical-align: top; }
        .grid-table tr:last-child td { border-bottom: none; }
        
        .label { color: #6b7280; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 2px; }
        .value { color: #111827; font-weight: bold; font-size: 14px; }
        
        .section-title { 
            font-size: 14px; 
            color: #052669; 
            font-weight: bold; 
            margin-top: 25px; 
            margin-bottom: 15px; 
            text-transform: uppercase; 
            border-left: 3px solid #0AB3B6; 
            padding-left: 8px; 
        }
        
        .description { line-height: 1.6; color: #4b5563; font-size: 12px; text-align: justify; margin-bottom: 30px; }
        
        .amenities-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .amenities-table td { padding: 6px 0; width: 33.33%; font-size: 11px; color: #4b5563; }
        .dot { color: #0AB3B6; font-weight: bold; margin-right: 5px; }

        .footer { 
            position: fixed; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            background-color: white; 
            padding: 20px 40px; 
            border-top: 1px solid #e5e7eb; 
            text-align: center; 
        }
        .footer-info { font-size: 10px; color: #6b7280; margin-bottom: 5px; }
        .footer-info span { margin: 0 5px; }
        .footer-social { font-size: 10px; font-weight: bold; }
        .footer-social a { color: #0AB3B6; text-decoration: none; margin: 0 8px; text-transform: uppercase; }
        .copyright { font-size: 8px; color: #9ca3af; margin-top: 8px; }
    </style>
</head>
<body>
    @php
        // Helper to get characteristic value from pivot table safely
        $getCarac = function($key) use ($propiedad) {
            $caracteristica = $propiedad->caracteristicas->first(function($c) use ($key) {
                // Check if the localized name exists, default to 'es' or empty string
                $nombre = strtolower($c->nombre[app()->getLocale()] ?? $c->nombre['es'] ?? '');
                return str_contains($nombre, $key);
            });
            return $caracteristica ? $caracteristica->pivot->valor : '0';
        };
    @endphp

    <div class="header">
        <div class="header-content">
            <h1>{{ $propiedad->nombre[app()->getLocale()] ?? 'Propiedad' }}</h1>
            <h2>{{ $propiedad->localidad->nombre[app()->getLocale()] ?? '' }}</h2>
        </div>
    </div>

    <div class="container">
        <!-- Price -->
        <div class="price">
            ${{ number_format($propiedad->precio[app()->getLocale()]['precio'] ?? 0, 0) }} 
            <span style="font-size: 14px; font-weight: normal; color: #9ca3af;">{{ $propiedad->precio[app()->getLocale()]['moneda'] ?? 'MXN' }}</span>
        </div>

        <!-- Specifications Grid -->
        <div class="section-title">Especificaciones</div>
        <table class="grid-table">
            <tr>
                <td>
                    <span class="label">Tipo de Inmueble</span>
                    <span class="value">{{ $propiedad->tipoInmueble->nombre[app()->getLocale()] ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Operación</span>
                    <span class="value">{{ $propiedad->tipoOperacion->nombre[app()->getLocale()] ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Recámaras</span>
                    <span class="value">{{ $getCarac('recámara') }}</span>
                </td>
                <td>
                    <span class="label">Baños</span>
                    <span class="value">{{ $getCarac('baño') }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Metros Totales</span>
                    <span class="value">{{ $getCarac('metros cuadrados') ?: $getCarac('construcción') ?: '0' }} m²</span>
                </td>
                <td>
                    <span class="label">Estacionamientos</span>
                    <span class="value">{{ $getCarac('estacionamiento') }}</span>
                </td>
            </tr>
        </table>

        <!-- Amenities -->
        @if($propiedad->amenidades->count() > 0)
        <div class="section-title">Amenidades</div>
        <table class="amenities-table">
            <tr>
                @foreach($propiedad->amenidades as $index => $amenidad)
                    @if($index > 0 && $index % 3 == 0) </tr><tr> @endif
                    <td><span class="dot">•</span> {{ $amenidad->nombre[app()->getLocale()] ?? $amenidad->nombre['es'] }}</td>
                @endforeach
                @for($i = 0; $i < (3 - ($propiedad->amenidades->count() % 3)) % 3; $i++)
                    <td></td>
                @endfor
            </tr>
        </table>
        @endif

        <!-- Description -->
        <div class="section-title">Descripción</div>
        <div class="description">
            {!! strip_tags($propiedad->descripcion[app()->getLocale()] ?? 'Sin descripción disponible.') !!}
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-info">
            @if(!empty($siteSettings->email))
                <span>{{ $siteSettings->email }}</span>
            @endif
            @if(!empty($siteSettings->email) && !empty($siteSettings->phone)) • @endif
            @if(!empty($siteSettings->phone))
                <span>{{ $siteSettings->phone }}</span>
            @endif
        </div>
        
        <div class="footer-social">
            @if(!empty($siteSettings->facebook_url))
                <a href="{{ $siteSettings->facebook_url }}">Facebook</a>
            @endif
            @if(!empty($siteSettings->instagram_url))
                <a href="{{ $siteSettings->instagram_url }}">Instagram</a>
            @endif
            @if(!empty($siteSettings->twitter_url))
                <a href="{{ $siteSettings->twitter_url }}">Twitter / X</a>
            @endif
            @if(!empty($siteSettings->linkedin_url))
                <a href="{{ $siteSettings->linkedin_url }}">LinkedIn</a>
            @endif
        </div>

        <div class="copyright">
            Generado por {{ $siteSettings->site_name ?? 'MiSitio' }} - {{ date('d/m/Y') }}
        </div>
    </div>
</body>
</html>
