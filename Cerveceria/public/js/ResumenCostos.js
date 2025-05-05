export function calcularCostoTotal(ingredientes) {
  let costoTotal = 0;
  for (let i = 0; i < ingredientes.length; i++) {
    const ingrediente = ingredientes[i];
    costoTotal = costoTotal + ingrediente.cantidad * ingrediente.precioUnitario;
  }
  return costoTotal;
}

/*Ejemplo de uso:

const ingredientes = [
    { nombre: "Malta", cantidad: 5, precioUnitario: 200 }, // por kg
    { nombre: "Lúpulo", cantidad: 0.2, precioUnitario: 1500 } // por kg
  ];

console.log("Costo total: bs." + calcularCostoTotal(ingredientes));

*/