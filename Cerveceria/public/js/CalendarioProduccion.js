 
export function calcularFechaFinal(fechaInicio, dias) {
  const fecha = new Date(fechaInicio);
  fecha.setDate(fecha.getDate() + dias);
  return fecha.toISOString().split('T')[0]; // Devuelve en formato YYYY-MM-DD
}

/* Ejemplo de uso: 

  const lotes = [
    { nombre: "Golden Ale", fechaInicio: "2025-04-01", diasFermentacion: 10 },
    { nombre: "IPA", fechaInicio: "2025-04-05", diasFermentacion: 14 }
  ];
  
  lotes.forEach(lote => {
    console.log(`${lote.nombre}: termina el ${calcularFechaFinal(lote)}`);
  });
  
*/