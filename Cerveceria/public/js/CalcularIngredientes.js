export function calcularIngredientes(volumenLote, recetaBase, litrosReceta) {
    var resultado = [];

    for (var i = 0; i < recetaBase.length; i++) {

      var ingredienteBase = recetaBase[i];
      var cantidadRequerida = (ingredienteBase.cantidadBase * volumenLote) / litrosReceta;

      resultado.push({
        ...ingredienteBase, cantidadNecesaria: parseFloat(cantidadRequerida)
      });
    }
    return resultado;
}

/*  Ejemplo de uso:

        const recetaGoldenAle = [
            { nombre: "Malta Pilsner", cantidadBase: 5 }, // 5kg por cada 100L
            { nombre: "Lúpulo Cascade", cantidadBase: 0.15 }, // 150g por cada 100L
            { nombre: "Levadura", cantidadBase: 0.05 }, // 50g por cada 100L
            { nombre: "Agua", cantidadBase: 110 } // 110L por cada 100L
        ];
        
        const lote = 100; // Lote es la cantidad de litros que se desea preparar

        const ingredientes = calcularIngredientes(lote, recetaGoldenAle);
        console.log(ingredientes);
*/