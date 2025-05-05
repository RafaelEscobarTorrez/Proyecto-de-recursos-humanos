export function produccionPorMes(lotes) {
  const resumen = {};

  lotes.forEach(l => {
    const mes = l.fecha.slice(0, 7); // extrae el año y mes en formato cadena
    if (!resumen[mes]) resumen[mes] = [];

    resumen[mes].push({
      nombre: l.nombre,
      litros: l.litros
    });
  });
  return resumen;
}

/* Ejemplo de uso: 

const lotes = [
  { nombre: "Golden Ale", litros: 250, fecha: "2025-01-15" },
  { nombre: "IPA", litros: 300, fecha: "2025-01-22" },
  { nombre: "Lager", litros: 200, fecha: "2025-02-10" }
];

console.log(produccionPorMes(lotes));

*/