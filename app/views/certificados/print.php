<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Finalización</title>
    <style>
        body { font-family: 'Georgia', serif; text-align: center; padding: 50px; border: 10px solid #ddd; margin: 20px; }
        .container { border: 5px solid #000; padding: 40px; }
        h1 { font-size: 48px; color: #333; margin-bottom: 10px; }
        h2 { font-size: 24px; color: #666; margin-top: 0; }
        .name { font-size: 32px; font-weight: bold; border-bottom: 2px solid #333; display: inline-block; padding: 10px 50px; margin: 20px 0; }
        .details { font-size: 18px; margin: 20px 0; line-height: 1.6; }
        .footer { margin-top: 60px; display: flex; justify-content: space-around; }
        .signature { border-top: 1px solid #000; padding-top: 10px; width: 30%; }
        .uuid { font-size: 12px; color: #999; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Certificado de Pasantía</h1>
        <h2>Otorgado a:</h2>
        
        <div class="name"><?php echo $data['pasantia']->nombre_estudiante; ?></div>

        <div class="details">
            <p>Por haber completado satisfactoriamente su pasantía profesional en la empresa:</p>
            <h3><?php echo $data['pasantia']->nombre_empresa; ?></h3>
            <p>
                <strong>Calificación General:</strong> <?php echo $data['evaluacion']->calificacion_general; ?> / 10 <br>
                <strong>Periodo:</strong> <?php echo date('d/m/Y', strtotime($data['pasantia']->fecha_inicio)); ?> - <?php echo date('d/m/Y', strtotime($data['pasantia']->fecha_fin)); ?>
            </p>
            <p>Se extiende la presente constancia para los usos que el interesado estime conveniente.</p>
        </div>

        <div class="footer">
            <div class="signature">Firma Empresa</div>
            <div class="signature">Firma Coordinación</div>
        </div>

        <div class="uuid">
            ID del Certificado: <?php echo $data['uuid']; ?> <br>
            Emisión: <?php echo $data['fecha_emision']; ?>
        </div>
        
        <br>
        <button onclick="window.print()">Imprimir / Guardar PDF</button>
    </div>
</body>
</html>
