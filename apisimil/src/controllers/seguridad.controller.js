import { getConnection } from "../database/database";

//API PARA SELECCIONAR DATOS DEL MODULO DE SEGURIDAD DEL PROCEDIMIENTO A_SELECT_MODULO_SEGURIDAD
const getSeguridadSing = async (req, res) => {
  try {
    console.log(req.params);
    const { PV_ACCION } = req.params;
    const connection = await getConnection();
    const result = await connection.query('CALL A_SELECT_MODULO_SEGURIDAD (?) ', PV_ACCION);
    res.json(result);
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal Server Error" });
  }
};


// API PARA INSERTAR DATOS DEL MODULO DE SEGURIDAD  DEL PROCEDIMIENTO ALMACENADO A_INSERT_MODULO_SEGURIDAD
const addSeguridad = async (req, res) => {
  try {
    //parametros de la tablas del modulo se seguridad sonse se insertan los datos a actualizar
    const {
        PV_ACCION,PV_NOM_ROL, PV_DES_ROL,  PE_ESTADO,PV_PREGUNTA,PV_OBJETO, PV_DES_OBJETO, PV_TIP_OBJETO,
        PV_PARAMETRO,PV_VALOR,PB_COD_ROL,PB_COD_OBJETO,PE_PER_INSERCION,PE_PER_ELIMINACION, PE_PER_ACTUALIZACION, 
        PE_PER_CONSULTAR,PB_COD_PERSONA,PV_COD_USUARIO,PV_CONTRASEÑA,PE_ESTADO_USUARIO,PT_FEC_ULTIMA_CONECCION,
        PI_PREGUNTAS_CONTESTADAS,PT_PRIMER_INGRESO,PD_FEC_VENCIMIENTO,PB_COD_PREGUNTA,PV_RESPUESTA 
    } = req.body;
    const connection = await getConnection();
    await connection.query(
      'CALL A_INSERT_MODULO_SEGURIDAD(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [ // Parametro recibidos en el procedimiento
        PV_ACCION,PV_NOM_ROL, PV_DES_ROL,  PE_ESTADO,PV_PREGUNTA,PV_OBJETO, PV_DES_OBJETO, PV_TIP_OBJETO,
        PV_PARAMETRO,PV_VALOR,PB_COD_ROL,PB_COD_OBJETO,PE_PER_INSERCION,PE_PER_ELIMINACION, PE_PER_ACTUALIZACION, 
        PE_PER_CONSULTAR,PB_COD_PERSONA,PV_COD_USUARIO,PV_CONTRASEÑA,PE_ESTADO_USUARIO,PT_FEC_ULTIMA_CONECCION,
        PI_PREGUNTAS_CONTESTADAS,PT_PRIMER_INGRESO,PD_FEC_VENCIMIENTO,PB_COD_PREGUNTA,PV_RESPUESTA 
]);
    
    res.json("Dato insertados");
    } catch (error) {
      console.error("Error executing query:", error);
      res.status(500).json({ error: "Internal Server Error" });
    }
  };

//API PARA ACTUALIZARDATOS DATOS DEL MODULO DE SEGURIDAD POR MEDIO DE UN PARAMETRO
  const updateSeguridad = async (req, res) => {
    try {
      //parametros de la tablas del modulo se seguridad sonse se actualizan los datos a actualizar
      const {
        
        
        PV_ACCION,PB_COD_ROL,PV_NOM_ROL, PV_DES_ROL,PE_ESTADO,  
        PB_COD_OBJETO ,PV_OBJETO, PV_DES_OBJETO, PV_TIP_OBJETO,
        PB_COD_PERMISO,PE_PER_INSERCION,PE_PER_ELIMINACION, PE_PER_ACTUALIZACION, PE_PER_CONSULTAR,
        PB_COD_PREGUNTA,PV_PREGUNTA,
        PB_COD_RESPUESTA_USUARIO ,PV_RESPUESTA,
        PB_COD_PARAMETRO,PV_PARAMETRO,PV_VALOR,
        PB_COD_PERSONA,PB_COD_USUARIO,PV_CONTRASEÑA,PE_ESTADO_USUARIO,PT_FEC_ULTIMA_CONECCION,
        PI_PREGUNTAS_CONTESTADAS,PT_PRIMER_INGRESO,PD_FEC_VENCIMIENTO
      } = req.body;
      const connection = await getConnection();
      await connection.query(
        'CALL A_UPDATE_MODULO_SEGURIDAD(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [ // Parametro recibidos en el procedimiento
        PV_ACCION,PB_COD_ROL,PV_NOM_ROL, PV_DES_ROL,PE_ESTADO,  
        PB_COD_OBJETO ,PV_OBJETO, PV_DES_OBJETO, PV_TIP_OBJETO,
        PB_COD_PERMISO,PE_PER_INSERCION,PE_PER_ELIMINACION, PE_PER_ACTUALIZACION, PE_PER_CONSULTAR,
        PB_COD_PREGUNTA,PV_PREGUNTA,
        PB_COD_RESPUESTA_USUARIO ,PV_RESPUESTA,
        PB_COD_PARAMETRO,PV_PARAMETRO,PV_VALOR,
        PB_COD_PERSONA,PB_COD_USUARIO,PV_CONTRASEÑA,PE_ESTADO_USUARIO,PT_FEC_ULTIMA_CONECCION,
        PI_PREGUNTAS_CONTESTADAS,PT_PRIMER_INGRESO,PD_FEC_VENCIMIENTO 
  ]);
      
      res.json("Dato Actualizados");
      } catch (error) {
        console.error("Error executing query:", error);
        res.status(500).json({ error: "Internal Server Error" });
      }
  };

  // este es un mensaje de prueba



  
  export const methods = {
    getSeguridadSing,
    updateSeguridad,
    addSeguridad
};