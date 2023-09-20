import { getConnection } from "../database/database";

//API PARA SELECCIONAR DATOS DEL MODULO PERSONA DEL PROCEDIMIENTO PER_SELECT_MODULO_PERSONA
const getPersonaSing = async (req, res) => {
  try {
    console.log(req.params);
    const { PV_ACCION } = req.params;
    const connection = await getConnection();
    const result = await connection.query('CALL PER_SELECT_MODULO_PERSONA (?) ', PV_ACCION);
    res.json(result);
  } catch (error) {
    console.error("Error executing query:", error);
    res.status(500).json({ error: "Internal Server Error" });
  }
};


// API PARA INSERTAR DATOS DEL MODULO PERSONA DEL PROCEDIMIENTO ALMACENADO PER_INSERT_MODULO_PERSONAS
const addPersona = async (req, res) => {
  try {
    //parametros de la tablas del modulo persona donde se insertan los datos a actualizar
    const {
        PV_ACCION,PV_IDENTIDAD,PV_NOM_PERSONA,PC_SEX_PERSONA,PI_EDA_PERSONA,PC_TIP_PERSONA,PC_ESTADO,
        PV_NUM_TELEFONO,PC_TIP_TELEFONO,PV_DESCRIPCIONT,PV_DIRECCION,PC_TIP_DIRECCION,PV_DESCRIPCIOND,
        PV_CORREO,PC_TIP_CORREO,PV_DESCRIPCIONC,PI_COD_PERSONA,PV_NOM_EMPRESA,PI_RTN,PV_REGION,PV_NOM_SUCURSAL
    } = req.body;
    const connection = await getConnection();
    await connection.query(
      'CALL PER_INSERT_MODULO_PERSONAS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      [ // Parametro recibidos en el procedimiento
        PV_ACCION,PV_IDENTIDAD,PV_NOM_PERSONA,PC_SEX_PERSONA,PI_EDA_PERSONA,PC_TIP_PERSONA,PC_ESTADO,
        PV_NUM_TELEFONO,PC_TIP_TELEFONO,PV_DESCRIPCIONT,PV_DIRECCION,PC_TIP_DIRECCION,PV_DESCRIPCIOND,
        PV_CORREO,PC_TIP_CORREO,PV_DESCRIPCIONC,PI_COD_PERSONA,PV_NOM_EMPRESA,PI_RTN,PV_REGION,PV_NOM_SUCURSAL
]);
    
    res.json("Dato insertados");
    } catch (error) {
      console.error("Error executing query:", error);
      res.status(500).json({ error: "Internal Server Error" });
    }
  };

//API PARA ACTUALIZAR DATOS DATOS DEL MODULO PERSONA POR MEDIO DE UN PARAMETRO
  const updatePersona = async (req, res) => {
    try {
      //parametros de las tablas del modulo persona donde se actualizan los registros a actualizar
      const {
        
        
        PV_ACCION,PI_COD_PERSONA,PV_IDENTIDAD,PV_NOM_PERSONA,PC_SEX_PERSONA,PI_EDA_PERSONA,PC_TIP_PERSONA,PC_ESTADO,  
        PI_COD_TELEFONO,PV_NUM_TELEFONO,PC_TIP_TELEFONO, PV_DESCRIPCIONT,PI_COD_PERSUCLITEL,PI_COD_DIRECCION,PV_DIRECCION,
        PC_TIP_DIRECCION,PV_DESCRIPCIOND,PI_COD_PERSUCLIDIR,PI_COD_CORREO, PV_CORREO,PC_TIP_CORREO,PV_DESCRIPCIONC,
        PI_COD_PERSUCLICOR,PI_COD_CLIENTE,PV_NOM_EMPRESA,PI_RTN,PV_REGION,PI_COD_SUCURSAL,PV_NOM_SUCURSAL
        
      } = req.body;
      const connection = await getConnection();
      await connection.query(
        'CALL PER_ACTUALIZAR_MODULO_PERSONA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [ // Parametro recibidos en el procedimiento
        PV_ACCION,PI_COD_PERSONA,PV_IDENTIDAD,PV_NOM_PERSONA,PC_SEX_PERSONA,PI_EDA_PERSONA,PC_TIP_PERSONA,PC_ESTADO,  
        PI_COD_TELEFONO,PV_NUM_TELEFONO,PC_TIP_TELEFONO, PV_DESCRIPCIONT,PI_COD_PERSUCLITEL,PI_COD_DIRECCION,PV_DIRECCION,
        PC_TIP_DIRECCION,PV_DESCRIPCIOND,PI_COD_PERSUCLIDIR,PI_COD_CORREO, PV_CORREO,PC_TIP_CORREO,PV_DESCRIPCIONC,
        PI_COD_PERSUCLICOR,PI_COD_CLIENTE,PV_NOM_EMPRESA,PI_RTN,PV_REGION,PI_COD_SUCURSAL,PV_NOM_SUCURSAL 
  ]);
      
      res.json("Dato Actualizados");
      } catch (error) {
        console.error("Error executing query:", error);
        res.status(500).json({ error: "Internal Server Error" });
      }
  };

  // este es un mensaje de prueba


  export const methods = {
    getPersonaSing,
    updatePersona,
    addPersona
};