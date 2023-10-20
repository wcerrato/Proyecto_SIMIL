import { getConnection } from "./../database/database";

//API PARA SELECCIONAR DATOS DEL MODULO DE INVENTARIO DEL PROCEDIMIENTO INV_SELECT_MODULO_INVENTARIO
const getInventarioSing = async (req, res) => {
  try {
    console.log(req.params);
    const { PV_ACCION } = req.params;
    const connection = await getConnection();
    const result = await connection.query('CALL INV_SELECT_MODULO_INVENTARIO (?); ', PV_ACCION);
    res.json(result);
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal Server Error" });
  }
};


// API PARA INSERTAR DATOS DEL MODULO DE INVENTARIO DEL PROCEDIMIENTO ALMACENADO ISV_INSERT_MODULO_INVENTARIO
const addInventario = async (req, res) => {
  try {
    //parametros de la tablas del modulo de inventario donde se insertan los datos a actualizar
    const {
        PV_ACCION, PB_COD_PRODUCTO, PI_CAN_EXISTENTE,  PB_COD_SUCURSAL, PI_CAN_MAXIMA, PI_CAN_MINIMA, PE_ESTADO, PB_COD_INVENTARIO_EXISTENTE,
        PV_COD_USUARIO, PE_TIPO_MOVIMIENTO, PV_DESCRIPCION_MOVIMIENTO, PI_CANTIDAD, PV_PRODUCTO_TERMINADO, PB_COD_PRODUCCION 
    } = req.body;
    const connection = await getConnection();
    await connection.query(
      'CALL INV_INSERT_MODULO_INVENTARIO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [ // Parametro recibidos en el procedimiento
        PV_ACCION, PB_COD_PRODUCTO, PI_CAN_EXISTENTE, PB_COD_SUCURSAL, PI_CAN_MAXIMA, PI_CAN_MINIMA, PE_ESTADO, PB_COD_INVENTARIO_EXISTENTE,
        PV_COD_USUARIO, PE_TIPO_MOVIMIENTO, PV_DESCRIPCION_MOVIMIENTO, PI_CANTIDAD, PV_PRODUCTO_TERMINADO, PB_COD_PRODUCCION
]);
  
    res.json("Datos insertados");
    } catch (error) {
      console.error("Error executing query:", error);
      res.status(500).json({ error: "Internal Server Error" });
    }
  };

//API PARA ACTUALIZAR LOS DATOS DEL MODULO DE INVENTARIO POR MEDIO DE UN PARAMETRO
  const updateInventario = async (req, res) => {
    try {
      //parametros de la tablas del modulo se inventario donde se actualizan los datos
      const {
        
        
        PV_ACCION, PB_COD_PRODUCTO, PI_CAN_EXISTENTE, PB_COD_SUCURSAL, PI_CAN_MAXIMA, PI_CAN_MINIMA, PE_ESTADO, PB_COD_INVENTARIO_EXISTENTE,
        PE_TIPO_MOVIMIENTO, PV_DESCRIPCION_MOVIMIENTO, PT_FECHA, PI_CANTIDAD, PB_COD_KARDEX, PV_PRODUCTO_TERMINADO, PV_COD_USUARIO, PB_COD_PRODUCCION

      } = req.body;
      const connection = await getConnection();
      await connection.query(
        'CALL INV_UPDATE_MODULO_INVENTARIO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [ // Parametro recibidos en el procedimiento
        PV_ACCION, PB_COD_PRODUCTO, PI_CAN_EXISTENTE, PB_COD_SUCURSAL, PI_CAN_MAXIMA, PI_CAN_MINIMA, PE_ESTADO, PB_COD_INVENTARIO_EXISTENTE,
        PE_TIPO_MOVIMIENTO, PV_DESCRIPCION_MOVIMIENTO, PT_FECHA, PI_CANTIDAD, PB_COD_KARDEX, PV_PRODUCTO_TERMINADO, PV_COD_USUARIO, PB_COD_PRODUCCION
  ]);
      
      res.json("Datos Actualizados");
      } catch (error) {
        console.error("Error executing query:", error);
        res.status(500).json({ error: "Internal Server Error" });
      }
  };

  // este es un mensaje de prueba

export const methods = {
    addInventario,
    getInventarioSing,
    updateInventario
};