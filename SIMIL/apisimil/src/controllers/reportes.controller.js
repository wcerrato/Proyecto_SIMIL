import { getConnection } from "../database/database";

//API PARA SELECCIONAR LOS REPORTES DEL PROCEDIMIENTO REPORTES
const getReportes = async (req, res) => {
  try {
    console.log(req.params);
    const { PV_ACCION } = req.params;
    const { PB_NUM_FACTURA,PB_COD_CLIENTE,PV_NOM_PROVEEDOR } = req.body;
    const connection = await getConnection();
    const result = await connection.query('CALL REPORTES(?, ?, ?, ?)', [PV_ACCION, PB_NUM_FACTURA, PB_COD_CLIENTE, PV_NOM_PROVEEDOR]);
    res.json(result);
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal Server Error" });
  }
};

  export const methods = {
    getReportes
 
};

