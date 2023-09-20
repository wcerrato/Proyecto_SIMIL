import { getConnection } from "../database/database";

// API PARA SELECCIONAR DATOS DEL MODULO COMPRAS

const getcompras = async (req, res) => {
  try {
    console.log(req.params);
    const { PV_ACCION } = req.params;
    const connection = await getConnection();
    const result = await connection.query('CALL PA_SELECT_MODULO_COMPRAS(?) ', PV_ACCION);
    res.json(result);
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal Server Error" });
  }
};

// API PARA INSERTAR DATOS DEL MODULO COMPRAS DEL PROCEDIMIENTO ALMACENADO PA_INSERT_COMPRAS
const addcompras = async (req, res) => {
  try {
    // PARAMETROS DEL MODULO COMPRAS
    const {
     PV_ACCION, PV_NOM_CATEGORIA, PE_ESTADO, PT_FEC_COMPRA, PD_TOT_COMPRA, PV_FACTURA_NO, PB_COD_PROVEEDOR, PB_COD_FORMA_PAGO,
     PI_CANTIDAD, PD_PRECIO_UNITARIO, PB_COD_ENC_COMPRA, PB_COD_PRODUCTO, PV_NOM_PRODUCTO, PD_DESC_PRODUCTO, PB_COD_CATEGORIA,
     PV_NOM_PROVEEDOR, PV_DNI_RTN, PV_PRO_DIRECCION, PV_PRO_TELEFONO, PV_PRO_CORREO
    } = req.body;
    const connection = await getConnection();
    await connection.query(
      'CALL PA_INSERT_MODULO_COMPRAS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [ // PARAMETROS RECIBIDOS DEL PROCEDIMIENTO
      PV_ACCION, PV_NOM_CATEGORIA, PE_ESTADO, PT_FEC_COMPRA, PD_TOT_COMPRA, PV_FACTURA_NO, PB_COD_PROVEEDOR, PB_COD_FORMA_PAGO,
     PI_CANTIDAD, PD_PRECIO_UNITARIO, PB_COD_ENC_COMPRA, PB_COD_PRODUCTO, PV_NOM_PRODUCTO, PD_DESC_PRODUCTO, PB_COD_CATEGORIA,
     PV_NOM_PROVEEDOR, PV_DNI_RTN, PV_PRO_DIRECCION, PV_PRO_TELEFONO, PV_PRO_CORREO 
]);
    
    res.json("Datos ingresados con exito");
    } catch (error) {
      console.error("Error executing query:", error);
      res.status(500).json({ error: "Internal Server Error" });
    }
  };

  //API PARA ACTUALIZAR DATOS DEL MODULO COMPRAS MEDIANTE EL PROCEDIMIENTO ALMACENADO PA_UPDATE_COMPRAS
  const updatecompras = async (req, res) => {
    try {
      // PARAMETROS DE LAS TABLAS DEL MODULO COMPRAS
      const {
        
        
    PV_ACCION,PV_NOM_CATEGORIA, PE_ESTADO, PB_COD_CATEGORIA, PT_FEC_COMPRA, PD_TOT_COMPRA, PV_FACTURA_NO, PB_COD_PROVEEDOR, 
    PB_COD_FORMA_PAGO, PB_COD_ENC_COMPRA, PI_CANTIDAD, PD_PRECIO_UNITARIO, PB_COD_PRODUCTO, PB_COD_LNS_COMPRA, PV_NOM_PRODUCTO,
    PV_DESC_PRODUCTO, PV_NOM_PROVEEDOR, PV_DNI_RTN, PB_COD_DIRECCION, PB_COD_TELEFONO, PB_COD_CORREO, PB_COD_PROVEEDOR_PRODUCTO
    
      } = req.body;
      const connection = await getConnection();
      await connection.query(
        'CALL PA_UPDATE_MODULO_COMPRAS (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
       
        [ // PARAMETROS RECIBIDOS DEL PROCEDIMIENTO
   
        PV_ACCION,PV_NOM_CATEGORIA, PE_ESTADO, PB_COD_CATEGORIA, PT_FEC_COMPRA, PD_TOT_COMPRA, PV_FACTURA_NO, PB_COD_PROVEEDOR, 
    PB_COD_FORMA_PAGO, PB_COD_ENC_COMPRA, PI_CANTIDAD, PD_PRECIO_UNITARIO, PB_COD_PRODUCTO, PB_COD_LNS_COMPRA, PV_NOM_PRODUCTO,
    PV_DESC_PRODUCTO, PV_NOM_PROVEEDOR, PV_DNI_RTN, PB_COD_DIRECCION, PB_COD_TELEFONO, PB_COD_CORREO, PB_COD_PROVEEDOR_PRODUCTO

  ]);
      
      res.json("Datos actualizados con exito");
      } catch (error) {
        console.error("Error executing query:", error);
        res.status(500).json({ error: "Internal Server Error" });
      }
  };


export const methods = {
    getcompras,
    addcompras,
    updatecompras
};