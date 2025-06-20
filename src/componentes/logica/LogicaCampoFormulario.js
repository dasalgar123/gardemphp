import React from 'react';

const CampoFormulario = ({ campo, formData, setFormData, accionActiva }) => {
  const { name, label, type, options, optional } = campo;

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const isDisabled = accionActiva === 'Dar de baja';
  const isRequired =
    !optional &&
    accionActiva !== 'Dar de baja' &&
    accionActiva !== 'Buscar' &&
    accionActiva !== 'Modificar';

  if (type === 'select') {
    return (
      <div className="campo">
        <label htmlFor={name}>{label}:</label>
        <select
          id={name}
          name={name}
          value={formData[name] || ''}
          onChange={handleInputChange}
          disabled={isDisabled}
          required={isRequired}
        >
          <option value="">Seleccione...</option>
          {options.map((opt) => (
            <option key={opt} value={opt}>
              {opt}
            </option>
          ))}
        </select>
      </div>
    );
  }

  if (type === 'textarea') {
    return (
      <div className="campo">
        <label htmlFor={name}>{label}:</label>
        <textarea
          id={name}
          name={name}
          value={formData[name] || ''}
          onChange={handleInputChange}
          rows={4}
          disabled={isDisabled}
          required={isRequired}
        />
      </div>
    );
  }

  return (
    <div className="campo">
      <label htmlFor={name}>{label}:</label>
      <input
        id={name}
        name={name}
        type={type}
        value={formData[name] || ''}
        onChange={handleInputChange}
        disabled={isDisabled}
        required={isRequired}
      />
    </div>
  );
};

export default CampoFormulario;
